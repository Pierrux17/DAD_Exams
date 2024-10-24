<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Question;
use Livewire\Component;

class ExamPage extends Component
{
    public $exam;
    public $token;
    public $questions = [];

    public function mount($token)
    {
        $this->token = $token;

        // Vérifier l'existence de l'examen avec le token
        $this->exam = Exam::where('token', $this->token)
            ->where('token_expires_at', '>', now())
            ->with(['user', 'topic'])
            ->first();

        if ($this->exam) {
            $this->questions = $this->exam->questions()->get();
        } else {
            abort(404, 'Examen non trouvé ou token expiré.');
        }
    }

    public function render()
    {
        return view('livewire.exam-page', [
            'exam' => $this->exam,
            'questions' => $this->questions
        ]);
    }
}
