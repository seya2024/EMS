<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make('Working Units')
                    ->items([
                        NavigationItem::make('District')
                            ->url(\App\Filament\Resources\Districts\DistrictResource::getUrl('index'))
                            ->icon('heroicon-o-map'),

                        // NavigationItem::make('HO')
                        //     ->url(\App\Filament\Resources\HO\HOResource::getUrl('index'))
                        //     ->icon('heroicon-o-office-building'),

                        NavigationItem::make('Branch')
                            ->url(\App\Filament\Resources\Branches\BranchResource::getUrl('index'))
                            ->icon('heroicon-o-office-building'),

                        NavigationItem::make('Outlet')
                            ->url(\App\Filament\Resources\Outlets\OutletResource::getUrl('index'))
                            ->icon('heroicon-o-collection'),
                    ]),
            ]);
        });
    }
}
