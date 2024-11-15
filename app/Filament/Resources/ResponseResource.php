<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Filament\Resources\ResponseResource\RelationManagers;
use App\Models\Response;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;


class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('exam_id')
                    ->relationship('exam', 'id')
                    ->required()
                    ->label('Examen'),
                Select::make('question_id')
                    ->relationship('question', 'id')
                    ->required()
                    ->label('Question'),
                Select::make('user_answer')
                    ->label('Réponse du participant')
                    ->options([
                        true => 'Oui',
                        false => 'Non',
                    ])
                    ->required(),
                Select::make('is_correct')
                    ->label('Correct')
                    ->options([
                        true => 'Oui',
                        false => 'Non',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam.id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('question.id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('user_answer')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                // Tables\Columns\TextColumn::make('user_answer')
                //     ->formatStateUsing(fn ($state) => $state ? 'Oui' : 'Non'),
                // Tables\Columns\TextColumn::make('is_correct')
                //     ->formatStateUsing(fn ($state) => $state ? 'Oui' : 'Non'),
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
            'index' => Pages\ListResponses::route('/'),
            'create' => Pages\CreateResponse::route('/create'),
            'edit' => Pages\EditResponse::route('/{record}/edit'),
        ];
    }
}
