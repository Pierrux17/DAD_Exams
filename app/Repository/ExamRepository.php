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

    public function __construct(Exam $exam, Response $response){
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
        try{
            $exam = $this->exam->findOrFail($examId);
            $exam->status = $status;
            return $exam->save();
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}