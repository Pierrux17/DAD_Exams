<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Filament\Resources\ExamResource;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Collection;

class LastestExams extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Derniers examens';

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
                    ->default('Entreprise'),
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
