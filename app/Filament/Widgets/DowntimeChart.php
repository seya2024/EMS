<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DowntimeChart extends ChartWidget
{

    protected ?string $heading = 'Total Computers as dashen Bank';

    protected ?string $description = 'Number of Computers per district';


    protected function getData(): array
    {
        // Example: number of ATMs down per district today
        $data = [
            'Jimma (1)' => 300,
            'Hawasa (2)' => 100,
            'Adama (3)' => 200,
            'Bahir Dar (4)' => 120,
            'Mekele (5)' => 450,
            'South West (6)' => 350,
            'Nekemete (7)' => 365,
            'Dessie(8)' => 50,
            'North Addis(9)' => 150,
            'South Addis(10)' => 450,
            'East Addis(11)' => 165,
            'West Addis(12)' => 150,
            'Dire Dawa (13)' => 160,
            'Wolaita (14)' => 190,
            'Head Office (15)' => 200,

        ];

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'label' => 'Number of Computers per district',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#4F46E5',
                        '#A78BFA',
                        '#C084FC',
                        '#9333EA',
                        '#7C3AED',
                        '#8B5CF6',
                        '#6366F1',
                        '#818CF8',
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'color' => '#4B5563',
                        'font' => ['size' => 12],
                    ],
                ],
                'datalabels' => [
                    'color' => '#fff',
                    'anchor' => 'end',
                    'align' => 'end',
                    'formatter' => "function(value) {
                        return value; // show just the number
                    }",
                    'font' => ['weight' => 'bold', 'size' => 12],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of ATMs Down',
                        'color' => '#4B5563',
                        'font' => ['size' => 12],
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'District',
                        'color' => '#4B5563',
                        'font' => ['size' => 12],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
