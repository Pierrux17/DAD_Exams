<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use App\Filament\Resources\ExamResource\Pages\CreateExam;
use App\Filament\Resources\ExamResource; 

class NewExamButton extends Widget
{
    protected static string $view = 'filament.resources.exam-resource.widgets.new-exam-button';

    protected function getViewData(): array
    {
        return [
            'register' => ExamResource::getUrl('exam_register'),
        ];
    }

    // public function render(): View
    // {
    //     return view(static::$view);
    // }
}