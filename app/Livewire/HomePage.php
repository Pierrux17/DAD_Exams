<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class HomePage extends Component
{
    public $token;
    public $showErrorPopup = false;

    public function submit()
    {
        $this->validate([
            'token' => 'required|string',
        ]);

        return Redirect::route('exam.show', ['token' => $this->token]);
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
