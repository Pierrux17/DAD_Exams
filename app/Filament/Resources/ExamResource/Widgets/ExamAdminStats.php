<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Models\Exam;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExamAdminStats extends BaseWidget
{
    protected static ?string $pollingInterval = '10s'; // Auto refresh
    protected function getStats(): array
    {
        $currentYear = now()->year;
        $previousYear = $currentYear - 1;

        // Calcul du taux de réussite pour l'année en cours
        $currentYearExams = Exam::whereYear('exam_date', $currentYear);
        $currentYearTotalExams = $currentYearExams->where('is_validated', true)->count();
        $currentYearPassedExams = $currentYearExams->where('status', 'Réussi')->where('is_validated', true)->count();
        
        $currentYearPassRate = $currentYearTotalExams > 0 ? round(($currentYearPassedExams / $currentYearTotalExams) * 100, 2) : 0;

        // Calcul du taux de réussite pour l'année précédente
        $previousYearExams = Exam::whereYear('exam_date', $previousYear);
        $previousYearTotalExams = $previousYearExams->where('is_validated', true)->count();
        $previousYearPassedExams = $previousYearExams->where('status', 'Réussi')->where('is_validated', true)->count();
        
        $previousYearPassRate = $previousYearTotalExams > 0 ? round(($previousYearPassedExams / $previousYearTotalExams) * 100, 2) : 0;

        // Déterminer la couleur et l'icône de la tendance
        $color = $currentYearPassRate >= $previousYearPassRate ? 'success' : 'danger';
        $trendIcon = $currentYearPassRate >= $previousYearPassRate ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        // Calcul de la différence
        $passRateDifference = abs(round($currentYearPassRate - $previousYearPassRate, 2));

        return [
            Stat::make('Total d\'examens', Exam::count()),

            Stat::make('Nombre d\'examens ' . now()->year, Exam::whereYear('exam_date', now()->year)->count())
                ->color('success'),

            Stat::make('Taux de réussite ' . $currentYear, $currentYearPassRate . '%')
                ->description(
                    $passRateDifference . '% ' . 
                    ($currentYearPassRate >= $previousYearPassRate ? 'au-dessus' : 'en-dessous') . ' de ' . $previousYear
                )
                ->descriptionIcon($trendIcon)
                ->color($color)
        ];
    }
}
