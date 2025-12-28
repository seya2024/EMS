<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ComputerChart extends ChartWidget
{
    //protected ?string $heading = 'Computer Operating System Version - Window 11 per district';

    protected ?string $heading = 'Window 11 Upgrading';
    protected static ?int $navigationSort = 15;


    protected ?string $description = 'Number of Computers upgraded to Window 11 per district';
    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        // Adjusted example data
        $data = [
            'Jimma District' => 120,
            'Hawasa District' => 80,
            'Adama District' => 60,
            'Bahir Dar District' => 45,
            'Mekele District' => 70,
            'South West District' => 30,
            'Nekemete District' => 55,
            'Dessie District' => 40,
        ];

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
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
                    'formatter' => "function(value, context) {
                        let total = context.dataset.data.reduce((a,b) => a+b, 0);
                        let percent = ((value / total) * 100).toFixed(1);
                        return percent + '%';
                    }",
                    'font' => ['weight' => 'bold', 'size' => 14],
                ],
            ],
        ];
    }
}
