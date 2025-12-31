<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\AtmDownCountChart;
use App\Filament\Widgets\ComputerChart;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class Dashboard extends BaseDashboard
{


    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;



    //------
}
