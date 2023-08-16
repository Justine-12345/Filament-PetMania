<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }



    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     dd($data);

    //     return $data;
    // }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Animal Has Been Updated';
    }
}
