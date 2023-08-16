<?php

namespace App\Filament\Resources\DiseaseResource\Pages;

use App\Filament\Resources\DiseaseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDisease extends CreateRecord
{
    protected static string $resource = DiseaseResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New Disease Has Been Added';
    }
}
