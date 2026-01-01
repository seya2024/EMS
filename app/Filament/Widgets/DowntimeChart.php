<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\District;
use App\Models\Branch;
use App\Models\Computer;

class DowntimeChart extends ChartWidget
{

    protected ?string $heading = 'Total Computers as dashen Bank';
    protected ?string $description = 'Number of Computers per district';
    //$data  = District::orderBy('id')->pluck('name')->toArray();
    protected function getData(): array
    {
        $districts = \App\Models\District::query()
            ->leftJoin('branches', 'branches.district_id', '=', 'districts.id')
            ->leftJoin('computers', 'computers.branch_id', '=', 'branches.id')
            ->select('districts.id', 'districts.name', \Illuminate\Support\Facades\DB::raw('COUNT(computers.id) as computers_count'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('districts.id')
            ->get()
            ->mapWithKeys(function ($district) {
                return ["{$district->name} ({$district->id})" => (int) $district->computers_count];
            })
            ->toArray();

        return [
            'labels' => array_keys($districts),
            'datasets' => [
                [
                    'label' => 'Number of Computers per district',
                    'data' => array_values($districts),
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
