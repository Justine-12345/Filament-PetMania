<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Actions;
use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
    use HasWizard;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New Animal Has Been Added';
    }


    protected function getSteps(): array
    {
        return [
            Step::make('Information')
                ->description('Provides identification')
                ->schema([
                    Card::make()
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')->required(),
                            TextInput::make('name')->required(),
                            TextInput::make('breed')->required(),
                            TextInput::make('age')->numeric()->required(),
                            Radio::make('gender')
                                ->options([
                                    'Male' => 'Male',
                                    'Female' => 'Female',
                                    'Unknown' => 'Unknown'
                                ])->required()
                        ])->columns(2)
                ]),
            Step::make('Description')
                ->description('Add some extra details')
                ->schema([
                    Card::make()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('picture')->collection('animals')->required(),
                            RichEditor::make('description')->required(),
                        ])
                ]),
            Step::make('Assingment')
                ->description('Control who can view it')
                ->schema([
                    Card::make()
                        ->schema([
                            Select::make('rescuers')
                                ->multiple()
                                ->relationship(
                                    'rescuers',
                                    'name',
                                    fn (Builder $query) =>
                                    $query->whereHas('role', function ($q) {
                                        $q->where('name', '=', 'Rescuer');
                                    })
                                )
                                ->preload(),
                            Select::make('animal_veterinarians')
                                ->multiple()
                                ->relationship(
                                    'animal_veterinarians',
                                    'name',
                                    fn (Builder $query) =>
                                    $query->whereHas('role', function ($q) {
                                        $q->where('name', '=', 'Veterinarian');
                                    })
                                )
                                ->preload(),
                            Select::make('adopters')
                                ->multiple()
                                ->relationship(
                                    'adopters',
                                    'name',
                                    fn (Builder $query) =>
                                    $query->whereHas('role', function ($q) {
                                        $q->where('name', '=', 'Adopter');
                                    })
                                )
                                ->preload(),
                            Select::make('diseases')
                                ->multiple()
                                ->relationship('diseases', 'name')
                                ->preload()
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state) {
                                    if (count($state) >= 1) {
                                        $set('is_healthy', false);
                                    } else {
                                        $set('is_healthy', true);
                                    }
                                }),
                            Hidden::make('is_healthy')->default(true)
                        ])->columns(2)
                ]),
        ];
    }
}
