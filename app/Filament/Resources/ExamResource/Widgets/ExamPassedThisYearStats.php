<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Models\Exam;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExamPassedThisYearStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nombre d\'examens en ' . now()->year, Exam::whereYear('exam_date', now()->year)->count())
                ->description('Nombre d\'examens passés cette année', IconPosition::Before)
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('success')
        ];
    }
}
