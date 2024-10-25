<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Response;
use App\Repositories\Interfaces\ExamRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class QuestionPage extends Component
{
    protected ExamRepositoryInterface $examRepository;

    public $exam;
    public $token;
    public $responses = [];
    public $userAnswers = [];

    public function boot(ExamRepositoryInterface $examRepository)
    {
        $this->examRepository = $examRepository;
    }


    public function mount($token)
    {
        $this->exam = $this->examRepository->findByToken($this->token);

        if ($this->exam) {
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

        // $this->exam->status = 'Terminé';
        // $this->exam->save();

        // $this->examRepository->updateStatus($this->exam->id, 'Terminé');

        $this->examRepository->evaluateExam($this->exam->id);

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
