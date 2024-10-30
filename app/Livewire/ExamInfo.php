<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

class ExamInfo extends Component
{
    public $exam;

    public function mount(Exam $exam){
        $this->exam = $exam;
    }

    public function render()
    {
        return view('livewire.exam-info');
    }
}
