<?php

namespace App\Livewire;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Response;
use App\Repositories\Interfaces\ExamRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ExamPage extends Component
{
    protected ExamRepositoryInterface $examRepository;
    public $exam;
    public $token;
    public $result;

    public function boot(ExamRepositoryInterface $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function mount($token)
    {
        $this->exam = $this->examRepository->findByToken($this->token);

        $this->examRepository->evaluateExam($this->exam->id);

        if (!$this->exam) {
            session()->flash('error', 'Examen non trouvé ou token expiré.');
            return redirect()->route('home');
        } else {

        }
    }

    public function submit()
    {
        $this->examRepository->updateStatus($this->exam->id, 'En cours');
        return Redirect::route('exam.questions', ['token' => $this->token]);
    }

    public function render()
    {
        return view('livewire.exam-page', [
            'exam' => $this->exam,
        ]);
    }
}
