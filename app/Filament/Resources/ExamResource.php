<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('result')
                    ->numeric()
                    ->label('Résultat')
                    ->required()
                    ->minValue(0)
                    ->maxValue(20)
                    ->step(1),
                Select::make('status')
                    ->label('Statut de l\'examen')
                    ->options([
                        'Raté' => 'Raté',
                        'Réussi' => 'Réussi',
                    ])
                    ->required(),
                Select::make('is_validated')
                    ->label('Validé')
                    ->options([
                        true => 'Oui',
                        false => 'Non',
                    ])
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->nullable()
                    ->label('Participant'),
                Select::make('topic_id')
                    ->relationship('topic', 'name')
                    ->nullable()
                    ->label('Topic'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('result')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_validated')
                    ->formatStateUsing(fn ($state) => $state ? 'Oui' : 'Non'),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('topic.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
