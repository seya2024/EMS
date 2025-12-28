<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;



class StatsOverview extends StatsOverviewWidget
{

    protected static ?int $navigationSort = 5;
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected function getStats(): array
    {
        return [
            Stat::make('Jimma District', '470')->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Hawasa District', '575')->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Nekemete District', '575')->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Adama District', '6464')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Hawasa District', '766')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Dire Dawa District', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Bahir Dar District', '192.1k')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),

            Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            // ...


        ];
    }

    // public static function canView(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }
}
