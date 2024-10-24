<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Components\Tab;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->unique(User::class, 'email', ignoreRecord: true)
                    // ->required(fn ($get) => $get('role') === 'admin')
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                // TextInput::make('password')
                //     ->password()
                //     ->required(fn ($get) => $get('role') === 'admin') // Mot de passe obligatoire pour admin
                //     ->visible(fn ($get) => $get('role') === 'admin'),
                TextInput::make('phone')
                    ->label('Téléphone')
                    ->nullable(),
                Select::make('role')
                    ->required()
                    ->default('client')
                    ->options([
                        'client' => 'Participant',
                        'admin' => 'Admin',
                    ])
                    ->label('Rôle'),
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(fn ($get) => $get('role') === 'client') // Obligatoire pour les participants
                    ->nullable()
                    ->label('Entreprise')
                    ->visible(fn ($get) => $get('role') === 'client'), // Visible uniquement pour les participants
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('role')
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
