<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\Question;
use App\Models\Response;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateExam extends CreateRecord
{
    protected static string $resource = ExamResource::class;

    protected function afterCreate(): void
    {
        $exam = $this->record;

        $token = $exam->generateToken();

        // Log::info("Token généré pour l'examen ID {$exam->id} : {$token}");

        $questions = Question::where('topic_id', $exam->topic_id)
        ->inRandomOrder()
        ->limit(3)
        ->get();

        foreach ($questions as $question) {
            Log::info($question->id . ' - ' . $question->text);
            Response::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'user_answer' => null,
                'is_correct' => false,
            ]);
        }
    }
}
