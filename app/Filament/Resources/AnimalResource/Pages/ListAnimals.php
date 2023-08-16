<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use App\Filament\Resources\AnimalResource\Widgets\AnimalChart;
use App\Filament\Resources\AnimalResource\Widgets\AnimalOverview;
use App\Filament\Resources\AnimalResource\Widgets\StatsOverview;
use App\Models\Animal;
use App\Models\User;
use Filament\Forms\Components\Builder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }

}
