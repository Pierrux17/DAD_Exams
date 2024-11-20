<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Filament\Resources\ExamResource;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class LastestExams extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Examens à valider';

    public function table(Table $table): Table
    {
        return $table
            ->query(ExamResource::getEloquentQuery()->whereNotIn('status', ['En cours', 'En attente'])->where('is_validated', false))
            ->defaultPaginationPageOption(10)
            ->defaultSort('exam_date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('exam_date')
                    ->label('Date')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y')),
                Tables\Columns\TextColumn::make('user.company.name')
                    ->sortable()
                    ->default('Entreprise')
                    ->label('Abattoir'),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('topic.name'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_validated')
                    ->formatStateUsing(fn ($state) => $state ? 'Oui' : 'Non')
                    ->label('Validé'),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('validate')
                        ->label('Valider les examens')
                        ->icon('heroicon-o-check')
                        ->action(function (Collection $records) {
                            $records->each(function (Exam $exam) {
                                $exam->update(['is_validated' => true]);
                            });

                            Notification::make()
                                ->title('Les examens ont été validés avec succès')
                                ->success()
                                ->send();
                        })
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();
                
                if ($user->isSupervisor()) {
                    $query->whereHas('user', function ($q) use ($user) {
                        $q->where('company_id', $user->company_id);
                    });
                }
                
                return $query;
            });
    }
}
