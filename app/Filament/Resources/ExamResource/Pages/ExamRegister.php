<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\Question;
use App\Models\Response;
use App\Models\Company;
use App\Models\Topic;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class ExamRegister extends CreateRecord
{
    protected static string $resource = ExamResource::class;

    public function form(Form $form): Form
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
                    Select::make('topic_id')
                        ->relationship('topic', 'name')
                        ->required()
                        ->options(function (callable $get) {
                            $companyId = $get('company_id');
                            if ($companyId) {
                                return Topic::whereHas('companies', function ($query) use ($companyId) {
                                    $query->where('companies.id', $companyId);
                                })->pluck('name', 'id');
                            }
                            return [];
                        })
                        ->disabled(fn (callable $get) => !$get('company_id')),

                    TextInput::make('place')
                        ->label('Lieu de l\'examen'),

                    DatePicker::make('exam_date')
                        ->label('Date de l\'examen')
                        ->required(),
                ])->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function afterCreate(): void
    {
        $exam = $this->record;

        $token = $exam->generateToken();

        $questions = Question::where('topic_id', $exam->topic_id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        foreach ($questions as $question) {
            Log::info($question->id . ' - ' . $question->text);
            Response::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'user_answer' => null,
                'is_correct' => false,
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.pages.dashboard');
    }
}