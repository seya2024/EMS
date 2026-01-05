<?php

namespace App\Filament\Pages;


use UnitEnum;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use App\Helpers\CalendarHelper;
use Filament\Support\Icons\Heroicon;

class WeeklyATMReport extends Page
{
    protected string $view = 'filament.pages.weekly-a-t-m-report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|UnitEnum|null $navigationGroup = 'Head Reports';

    public string $ecDate;
    public string $gcDate;

    public function mount(): void
    {
        /// Current Gregorian date
        $this->gcDate = Carbon::now()->toDateString();
        // Convert current Gregorian date to Ethiopian date
        $this->ecDate = CalendarHelper::gcToEc($this->gcDate);
    }

    //  public static function gcToEc(Carbon|string $gcDate): string
    // {
    //     return 
    // }
}
