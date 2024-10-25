<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Response;
use App\Repositories\Interfaces\ExamRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamRepository implements ExamRepositoryInterface
{
    protected Exam $exam;
    protected Response $response;
    protected const PASSING_SCORE = 50; //%

    public function __construct(Exam $exam, Response $response)
    {
        $this->exam = $exam;
        $this->response = $response;
    }

    public function findByToken(string $token)
    {
        return $this->exam = Exam::where('token', $token)
            ->where('token_expires_at', '>', now())
            ->with(['user', 'topic'])
            ->first();
    }

    public function updateStatus(int $examId, string $status): bool
    {
        try {
            $exam = $this->exam->findOrFail($examId);
            $exam->status = $status;
            return $exam->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function calculateResult(int $examId): array
    {
        $responses = $this->response
            ->where('exam_id', $examId)
            ->with('question')
            ->get();

        $totalQuestions = $responses->count();
        $correctAnswers = 0;

        foreach($responses as $response) {
            if($response->user_answer === $response->question->expected_answer){
                $correctAnswers++;
                $response->is_correct = true;
            } else {
                $response->is_correct = false;
            }
            $response->save();
        }

        return [
            'total' => $totalQuestions,
            'correct' => $correctAnswers,
            'percentage' => $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0
        ];
    }

    public function evaluateExam(int $examId): bool
    {
        try {
            DB::beginTransaction();

            $result = $this->calculateResult($examId);
            $isPassed = $result['percentage'] >= self::PASSING_SCORE;
            $status = $isPassed ? 'Réussi' : 'Échoué';

            $exam = $this->exam->findOrFail($examId);
            $exam->status = $status;
            $exam->result = $result['percentage'];
            $exam->save();

            DB::commit();

            Log::info("Évaluation de l'examen {$examId} terminée. Résultat: {$status}");
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de l'évaluation de l'examen {$examId}: " . $e->getMessage());
            return false;
        }
    }

    public function getExamWithResponses(int $examId)
    {
        return $this->exam
            ->with(['responses.question', 'user', 'topic'])
            ->findOrFail($examId);
    }
}
