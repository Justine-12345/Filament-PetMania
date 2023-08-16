<?php

namespace App\Filament\Resources\DiseaseResource\Pages;

use App\Filament\Resources\DiseaseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisease extends EditRecord
{
    protected static string $resource = DiseaseResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Disease Has Been Updated';
    }
}
