<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Events Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('job_title')->required(),
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\Select::make('industry')
                    ->options([
                        'technologies' => 'Technologies',
                        'sante' => 'Santé',
                        'finance' => 'Finance',
                        'education' => 'Éducation',
                        'industrie' => 'Industrie',
                        'autres' => 'Autres',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('motivation')->required(),
                Forms\Components\Textarea::make('contribution')->required(),
                Forms\Components\Select::make('previous_event')
                    ->options([
                        'yes' => 'Oui',
                        'no' => 'Non',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('previous_event_details')->maxLength(500),
                Forms\Components\TextInput::make('heard_about')->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('job_title')->label('Poste'),
                Tables\Columns\TextColumn::make('company_name')->label('Entreprise'),
                Tables\Columns\TextColumn::make('industry')->label('Secteur'),
                Tables\Columns\TextColumn::make('motivation')->limit(50),
                Tables\Columns\TextColumn::make('heard_about')->label('Source'),
                Tables\Columns\TextColumn::make('created_at')->label('Créé le')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver()->hiddenLabel(),
                Tables\Actions\EditAction::make()->slideOver()->hiddenLabel(),
                Tables\Actions\DeleteAction::make()->slideOver()->hiddenLabel(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
