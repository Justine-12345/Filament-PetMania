<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RescuedRelationManager extends RelationManager
{
    protected static string $relationship = 'rescued';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name'),
                        TextInput::make('name')->required(),
                        SpatieMediaLibraryFileUpload::make('picture')->collection('animals')->required(),
                        RichEditor::make('description')->required(),
                        Select::make('rescuers')
                            ->multiple()
                            ->relationship('rescuers', 'name', fn (Builder $query) => $query->where('role', "=", "Rescuer"))
                            ->preload(),
                        Select::make('animal_veterinarians')
                            ->multiple()
                            ->relationship('animal_veterinarians', 'name', fn (Builder $query) => $query->where('role', "=", "Veterinarian"))
                            ->preload(),
                        Select::make('adopters')
                            ->multiple()
                            ->relationship('adopters', 'name', fn (Builder $query) => $query->where('role', "=", "Adopter"))
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
                        Hidden::make('is_healthy')
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
                SpatieMediaLibraryImageColumn::make('picture')->collection('animals'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label("New Animal"),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
