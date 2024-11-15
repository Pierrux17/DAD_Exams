<?php

namespace App\Filament\Resources\ExamResource\Widgets;

use App\Filament\Resources\ExamResource;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExamsInProgress extends BaseWidget
{
    protected int | string | array $columnSpan = 'half';
    protected static ?string $heading = 'Examens en cours';

    public function table(Table $table): Table
    {
        return $table
            ->query(ExamResource::getEloquentQuery()->where('status', 'En cours'))
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
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
            ]);
    }
}
