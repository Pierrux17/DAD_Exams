<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Models\Exam;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExamSupervisorStats extends BaseWidget
{
    protected static ?string $pollingInterval = '10s'; // Auto refresh

    protected function getStats(): array
    {
        $user = auth()->user();
        
        if (!$user->isSupervisor()) {
            return []; // Pas de stats si l'utilisateur n'est pas superviseur
        }

        $currentYear = now()->year;
        $previousYear = $currentYear - 1;

        // Requêtes filtrées par company_id du superviseur
        $currentYearExams = Exam::whereYear('exam_date', $currentYear)
            ->whereHas('user', function($query) use ($user) {
                $query->where('company_id', $user->company_id);
            });

        $currentYearTotalExams = $currentYearExams->where('is_validated', true)->count();
        $currentYearPassedExams = $currentYearExams->where('status', 'Réussi')->where('is_validated', true)->count();

        $currentYearPassRate = $currentYearTotalExams > 0 ? round(($currentYearPassedExams / $currentYearTotalExams) * 100, 2) : 0;

        $previousYearExams = Exam::whereYear('exam_date', $previousYear)
            ->whereHas('user', function($query) use ($user) {
                $query->where('company_id', $user->company_id);
            });

        $previousYearTotalExams = $previousYearExams->where('is_validated', true)->count();
        $previousYearPassedExams = $previousYearExams->where('status', 'Réussi')->where('is_validated', true)->count();

        $previousYearPassRate = $previousYearTotalExams > 0 ? round(($previousYearPassedExams / $previousYearTotalExams) * 100, 2) : 0;

        // Déterminer la couleur et l'icône de la tendance
        $color = $currentYearPassRate >= $previousYearPassRate ? 'success' : 'danger';
        $trendIcon = $currentYearPassRate >= $previousYearPassRate ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        // Calcul de la différence
        $passRateDifference = abs(round($currentYearPassRate - $previousYearPassRate, 2));

        return [
            Stat::make('Nombre total d\'examens : ' . $user->company->name, 
                Exam::whereHas('user', function($query) use ($user) {
                    $query->where('company_id', $user->company_id);
                })->count()
            ),
            
            Stat::make('Examens ' . $currentYear . ' : ' . $user->company->name, 
                Exam::whereYear('exam_date', $currentYear)
                    ->whereHas('user', function($query) use ($user) {
                        $query->where('company_id', $user->company_id);
                    })->count()
            )->color('success'),
            
            Stat::make('Taux de réussite ' . $currentYear, $currentYearPassRate . '%')
                ->description(
                    $passRateDifference . '% ' . 
                    ($currentYearPassRate >= $previousYearPassRate ? 'au-dessus' : 'en-dessous') . 
                    ' de ' . $previousYear
                )
                ->descriptionIcon($trendIcon)
                ->color($color)
        ];
    }
}
