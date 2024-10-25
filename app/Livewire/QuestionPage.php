<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class QuestionPage extends Component
{
    public $exam;
    public $token;
    public $responses = [];
    public $userAnswers = [];

    public function mount($token)
    {
        $this->token = $token;

        // Vérifier l'existence de l'examen avec le token
        $this->exam = Exam::where('token', $this->token)
            ->where('token_expires_at', '>', now())
            ->with(['user', 'topic'])
            ->first();

        if ($this->exam) {
            // $this->responses = $this->exam->questions;
            $this->responses = Response::where('exam_id', $this->exam->id)
                ->with('question')
                ->get();

            foreach ($this->responses as $index => $response) {
                $this->userAnswers[$index] = $response->user_answer;
            }
        } else {
            abort(404, 'Examen non trouvé ou token expiré.');
        }
    }

    public function submitResponses()
    {
        foreach ($this->responses as $index => $response) {
            if (isset($this->userAnswers[$index])) {
                $response->user_answer = $this->userAnswers[$index];
                $response->is_correct = ($response->question->expected_answer == $this->userAnswers[$index]);
                
                Log::info("User answer for question ID {$response->question->id}: {$response->user_answer}");
                $response->save();
            }
        }

        $this->exam->status = 'Terminé';
        $this->exam->save();

        Log::info('Réponses soumises');
        session()->flash('message', 'Réponses soumises avec succès.');

        return Redirect::route('exam.show', ['token' => $this->token]);
    }

    public function render()
    {
        return view('livewire.question-page', [
            'exam' => $this->exam,
            'responses' => $this->responses,
        ]);
    }
}
