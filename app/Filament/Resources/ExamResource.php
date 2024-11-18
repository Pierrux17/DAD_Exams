<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Filament\Resources\ExamResource\RelationManagers\ResponsesRelationManager;
use App\Filament\Resources\ExamResource\RelationManagers\UserRelationManager;
use App\Models\Exam;
use App\Models\User;
use App\Models\Company;
use App\Models\Topic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Entreprise')->schema([
                    Select::make('company_id')
                        ->label('Abattoir')
                        ->options(Company::all()->pluck('name', 'id')->toArray())
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set) {
                            $set('user_id', null);
                        }),
                ])->columnSpan(1),

                Section::make('Participant')->schema([
                    Select::make('user_id')
                        ->label('Utilisateur')
                        ->required()
                        ->options(function (callable $get) {
                            $companyId = $get('company_id');
                            if ($companyId) {
                                return User::where('company_id', $companyId)
                                    ->where('role', 'client')
                                    ->pluck('name', 'id');
                            }
                            return [];
                        })
                        ->disabled(fn (callable $get) => !$get('company_id')),
                ])->columnSpan(1),

                Section::make('Informations')->schema([
                    Select::make('status')
                        ->options([
                            'En attente' => 'En attente',
                            'En cours' => 'En cours',
                            'Terminé' => 'Terminé',
                            'Réussi' => 'Réussi',
                            'Raté' => 'Raté',
                            'Erreur' => 'Erreur',
                        ]),
                    Select::make('topic_id')
                        ->relationship('topic', 'name')
                        ->required(),

                    TextInput::make('place')
                        ->label('Lieu de l\'examen'),

                    DatePicker::make('exam_date')
                        ->label('Date de l\'examen')
                        ->required(),
                    Select::make('is_validated')
                        ->label('Validé')
                        ->options([
                            true => 'Oui',
                            false => 'Non',
                        ])
                        ->default(false)
                        ->required(),
                ])->columns(3),

                Section::make('Résultat')->schema([
                    TextInput::make('result')
                        ->numeric(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam_date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('result')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_validated')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                // Tables\Columns\TextColumn::make('is_validated')
                //     ->formatStateUsing(fn($state) => $state ? 'Oui' : 'Non'),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.company.name')
                    ->label('Abattoir')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('topic.name')
            ])
            ->defaultSort('exam_date', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Filtrer par Statut')
                    ->options(array_combine(Exam::status(), Exam::status())),
                SelectFilter::make('user_id')
                    ->label('Filtrer par Utilisateur')
                    ->options(User::all()->pluck('name', 'id')->toArray()),
                Filter::make('topic_id')
                    ->form([
                        Forms\Components\CheckboxList::make('topics')
                            ->label('Filtrer par Topic')
                            ->options(Topic::all()->pluck('name', 'id')->toArray())
                            ->columns(1),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (isset($data['topics']) && !empty($data['topics'])) {
                            return $query->whereIn('topic_id', $data['topics']);
                        }
                        return $query;
                    }),
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
            // UserRelationManager::class,
            ResponsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            // 'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
            'exam_register' => Pages\ExamRegister::route('/exam-register'),
        ];
    }
}
