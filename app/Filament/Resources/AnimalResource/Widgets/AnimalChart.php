<?php

namespace App\Filament\Resources\AnimalResource\Widgets;

use App\Models\Animal;
use Filament\Widgets\BarChartWidget;

class AnimalChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getHeading(): string
    {
        return 'Rescued Animals';
    }
    public ?string $filter = 'today';
    
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $animalsPerMonth = Animal::query()
            ->selectRaw('DATE_FORMAT(created_at, "%M-%Y") as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [];
        $counts = [];
        foreach ($animalsPerMonth as $month => $count) {
            $months[] = $month;
            $counts[] = $count;
        }


        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $counts,
                ],
            ],
            'labels' => $months,
        ];
    }
}
