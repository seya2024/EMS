<?php

namespace App\Filament\Pages;

use BackedEnum;
use Carbon\Carbon;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\ComputerChart;
use App\Filament\Widgets\AtmDownCountChart;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Models\Branch;
use App\Models\Computer;
use App\Models\District;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{


    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;


    protected function getViewData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        return [

            // 'usersCount' => User::count(),
            // 'computerCount' => Computer::count(),
            // 'districtCount' => District::count(),
            // 'branchCount' => Branch::count(),



        ];
    }



    //  'usersCount' => User::count(),

}
