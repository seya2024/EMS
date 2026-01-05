<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class QuarterATMReport extends Page
{
    protected string $view = 'filament.pages.quarter-a-t-m-report';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|UnitEnum|null $navigationGroup = 'Head Reports';
}
