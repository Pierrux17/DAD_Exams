<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use Filament\Widgets\ChartWidget;

class ExamsChart extends ChartWidget
{
    protected static ?string $heading = 'Exam Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Exams passed',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}