<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Branch;

use App\Models\Computer;
use App\Models\District;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use GrahamCampbell\ResultType\Success;
use Symfony\Component\HttpKernel\Attribute\Cache;

class StatsOverview extends StatsOverviewWidget
{

    protected static ?int $navigationSort = 5;
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';



    protected function getData()
    {
        // Adjusted example data
        $data = [
            // 'Jimma District' => 120,
            // 'Hawasa District' => 80,
            // 'Adama District' => 60,
            // 'Bahir Dar District' => 45,
            // 'Mekele District' => 70,
            // 'South West District' => 30,
            // 'Nekemete District' => 55,
            // 'Dessie District' => 40,

            'usersCount' => User::count(),
            'computerCount' => Computer::count(),
            'districtCount' => District::count(),
            'branchCount' => Branch::count(),


        ];
    }

    protected function getStats(): array
    {

        $users = cache()->remember('users.count', 300, fn() => User::count());
        $branches = cache()->remember('branches.count', 300, fn() => Branch::count());
        $districts = cache()->remember('districts.count', 300, fn() => District::count());
        $computers = cache()->remember('users.count', 300, fn() => Computer::count());


        return [

            Stat::make('Users', $users . '-' . 'Staff')->color('primary')->description('Total Users')->descriptionIcon('heroicon-s-users'),
            Stat::make('Districts + HQ', $districts . '-' . 'Districts')->description('Total District')->descriptionIcon('heroicon-s-map')->color('primary'),
            Stat::make('Branches + Outlets', $branches . '-' . 'Branches')->description('Total Branches')->descriptionIcon('heroicon-s-building-office')->color('primary'),
            Stat::make('Computers', $computers . '-' . 'Computers')->description('Total Computers')->descriptionIcon('heroicon-s-computer-desktop')->color('primary'),
            Stat::make('Upgrading', 'Windows 10')->description('Operating System')->descriptionIcon('heroicon-s-computer-desktop')

                ->chart([17, 2, 10, 3, 15, 4, 3])


                ->color('warning'),

            Stat::make('Upgraded', 'Windows 11')->description('Operating System')->descriptionIcon('heroicon-s-computer-desktop')      //     ->chart([7, 2, 10, 3, 15, 4, 17])

                ->chart([15, 20, 25, 30, 50, 75, 90])
                ->color('success'),


            // Stat::make('Jimma District', '575')->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),

            // Stat::make('Hawasa District', '575')->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('danger'),

            // Stat::make('Nekemete District', '575')->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),

            // Stat::make('Adama District', '6464')
            //     ->description('32k increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),

            // Stat::make('Hawasa District', '766')
            //     ->description('7% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('danger'),

            // Stat::make('Dire Dawa District', '3:12')
            //     ->description('3% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),

            // Stat::make('Bahir Dar District', '192.1k')
            //     ->color('success')
            //     ->extraAttributes([
            //         'class' => 'cursor-pointer',
            //         'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            //     ]),

            // Stat::make('Unique views', '192.1k')
            //     ->description('32k increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->chart([7, 2, 10, 3, 15, 4, 17])
            //     ->color('success'),


        ];
    }

    // public static function canView(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }
}
