<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;
use App\Models\District;

class LineChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue Trend';

    public ?int $district_id = null;
    public ?string $filter = 'today';


    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }


    // Add select dropdown to the card header
    protected function headerActions(): array
    {
        return [
            Select::make('district_id')
                ->label('District')
                ->options(District::all()->pluck('name', 'id')->toArray())
                ->reactive()
                ->inlineLabel() // makes the label inline with select
                ->disablePlaceholderSelection(), // optional
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Example static data per district
        $data = [
            1 => [1200, 1500, 1700, 1400, 1900, 2200, 2000, 2300, 2100, 2400, 2500, 2600],
            2 => [1000, 1300, 1600, 1500, 1800, 2000, 1900, 2100, 2000, 2200, 2300, 2400],
            3 => [1100, 1400, 1500, 1300, 1700, 2100, 2050, 2250, 2150, 2350, 2450, 2550],
        ];

        $chartData = $this->district_id && isset($data[$this->district_id])
            ? $data[$this->district_id]
            : $data[1];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $chartData,
                    'borderColor' => 'blue',
                    'backgroundColor' => 'rgba(0, 0, 255, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
        ];
    }
}
