<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DoughnutChart extends ChartWidget
{
    protected ?string $heading = 'ATM Down time';
    public ?string $filter = 'today';

    protected function getType(): string
    {
        return 'doughnut';
    }


    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',

            //  Select::make('district_id')
            //     ->label('District')
            //     ->options(District::all()->pluck('name', 'id')->toArray())
            //     ->reactive()
            //     ->inlineLabel() // makes the label inline with select
            //     ->disablePlaceholderSelection(), // optional
        ];
    }



    protected function getData(): array
    {
        $activeFilter = $this->filter;
        return [
            'labels' => ['Vendor Case', 'Power', 'Cash-out', 'Network'],
            'datasets' => [
                [
                    'label' => 'Number of ATMs',
                    'data' => [35, 25, 20, 20], // static values
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                    ],
                ],
            ],
        ];
    }
}
