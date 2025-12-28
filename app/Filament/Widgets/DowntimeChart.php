<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DowntimeChart extends ChartWidget
{

    protected ?string $heading = 'Number of ATMs Downtime Today';

    protected ?string $description = 'Number of ATMs Downtime Today per district';


    protected function getData(): array
    {
        // Example: number of ATMs down per district today
        $data = [
            'Jimma' => 3,
            'Hawasa' => 1,
            'Adama' => 2,
            'Bahir Dar' => 0,
            'Mekele' => 1,
            'South West' => 2,
            'Nekemete' => 1,
            'Dessie' => 0,
        ];

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'label' => 'Number of ATMs Down',
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
