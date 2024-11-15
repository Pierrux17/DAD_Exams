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
    public $currentQuestionIndex = 0;

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

    public function nextQuestion()
    {
        // Save response
        if (isset($this->userAnswers[$this->currentQuestionIndex])) {
            $this->responses[$this->currentQuestionIndex]->user_answer = $this->userAnswers[$this->currentQuestionIndex];

            // Calculate if response is correct
            $this->responses[$this->currentQuestionIndex]->is_correct = ($this->responses[$this->currentQuestionIndex]->question->expected_answer === $this->userAnswers[$this->currentQuestionIndex]);

            Log::info('Réponse de l\'utilisateur pour la question ID ' . $this->responses[$this->currentQuestionIndex]->question->id . ': ' . $this->userAnswers[$this->currentQuestionIndex]);

            //Save in db
            $this->responses[$this->currentQuestionIndex]->save();
        }

        // Go to next question
        if ($this->currentQuestionIndex < count($this->responses) - 1) {
            $this->currentQuestionIndex++;
        } else {
            session()->flash('message', 'Vous avez atteint la dernière question.');
        }
    }

    public function submitResponses()
    {
        // Save last response
        if (isset($this->userAnswers[$this->currentQuestionIndex])) {
            $this->responses[$this->currentQuestionIndex]->user_answer = $this->userAnswers[$this->currentQuestionIndex];

            $this->responses[$this->currentQuestionIndex]->is_correct = ($this->responses[$this->currentQuestionIndex]->question->expected_answer === $this->userAnswers[$this->currentQuestionIndex]);

            Log::info('Réponse de l\'utilisateur pour la dernière question ID ' . $this->responses[$this->currentQuestionIndex]->question->id . ': ' . $this->userAnswers[$this->currentQuestionIndex]);

            $this->responses[$this->currentQuestionIndex]->save();
        }

        // Récap des réponses
        Log::info('Récapitulatif des réponses de l\'utilisateur :');
        foreach ($this->responses as $response) {
            Log::info('Question ID ' . $response->question->id
                . ', Réponse utilisateur : ' . $response->user_answer
                . ', Réponse attendue : ' . $response->question->expected_answer
                . ', Correct : ' . ($response->is_correct ? 'Oui' : 'Non'));
        }


        // Évaluer l'examen
        $this->examRepository->evaluateExam($this->exam->id);

        Log::info('Toutes les réponses ont été soumises.');

        session()->flash('message', 'Examen terminé. Vos réponses ont été soumises avec succès.');
        return Redirect::route('exam.show', ['token' => $this->token]);
    }


    public function render()
    {
        return view('livewire.question-page', [
            'exam' => $this->exam,
            'responses' => $this->responses,
            'currentResponse' => $this->responses[$this->currentQuestionIndex] ?? null,
            'totalQuestions' => count($this->responses),
            'currentQuestionNumber' => $this->currentQuestionIndex + 1,
        ]);
    }
}
