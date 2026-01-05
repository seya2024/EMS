<?php

namespace App\Filament\Pages;


use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use BackedEnum;

class WeeklyATMReport extends Page
{
    protected string $view = 'filament.pages.weekly-a-t-m-report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|UnitEnum|null $navigationGroup = 'Head Reports';
}
