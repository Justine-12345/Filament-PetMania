<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimalResource\Pages;
use App\Filament\Resources\AnimalResource\RelationManagers;
use App\Filament\Resources\AnimalResource\Widgets\AnimalChart;
use App\Filament\Resources\AnimalResource\Widgets\AnimalOverview;
use App\Filament\Resources\AnimalResource\Widgets\StatsOverview;
use App\Models\Animal;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'category' => $record->category->name,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name'),
                        TextInput::make('name')->required()->dehydrated(false),
                        TextInput::make('breed')->required(),
                        TextInput::make('age')->numeric()->required(),
                        Radio::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Unknown' => 'Unknown'
                            ]),
                        SpatieMediaLibraryFileUpload::make('picture')->collection('animals')->required(),
                        RichEditor::make('description')->required(),
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
                            ->preload()
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, Closure $get) {
                                if (count($get('adopters')) <= 0) {
                                    $set('adoption_status', 'Unadopted');
                                }
                            }),
                        Radio::make('adoption_status')
                            ->options([
                                'Pending' => 'Pending',
                                'Adopted' => 'Adopted',
                            ])
                            ->hidden(fn (Closure $get): bool => count($get('adopters')) <= 0),
                        Hidden::make('adoption_status')->default('Unadopted'),
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
                        Hidden::make('is_healthy')->default(true),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('category.name'),
                TextColumn::make('name')->sortable()->searchable(),
                IconColumn::make('is_healthy')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                SpatieMediaLibraryImageColumn::make('picture')->collection('animals'),

            ])
            ->filters([
                SelectFilter::make('is_healthy')
                    ->options([
                        '1' => 'Healthy',
                        '0' => 'Unhealthy',
                    ])->label("Health status"),
                SelectFilter::make('adoption_status')
                    ->options([
                        'Unadopted' => 'Unadopted',
                        'Pending' => 'Pending',
                        'Adopted' => 'Adopted',
                    ]),
                SelectFilter::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Unknown' => 'Unknown',
                    ]),
                SelectFilter::make('category')->relationship('category', 'name'),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(fn (Animal $record): bool => Auth::user()->role->name == "Admin"),
            ])->poll('2s');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
            AnimalChart::class
        ];
    }


    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }
}
