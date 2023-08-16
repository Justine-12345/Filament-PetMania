<?php

namespace App\Filament\Resources\AnimalResource\Widgets;

use App\Models\Animal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{


    protected function getCards(): array
    {
        $animalsPerDay = Animal::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $animalsHealthyPerDay = Animal::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as count')
            ->where('is_healthy', '=', true)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $animalsUnhealthyPerDay = Animal::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as count')
            ->where('is_healthy', '=', false)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
        return [
            Card::make('Animals', Animal::count())
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($animalsPerDay)
                ->color('success'),
            Card::make('Healthy', Animal::where('is_healthy', '=', true)->count())
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($animalsHealthyPerDay)
                ->color('success'),
            Card::make('Unhealthy', Animal::where('is_healthy', '=', false)->count())
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($animalsUnhealthyPerDay)
                ->color('success'),
        ];
    }
}
