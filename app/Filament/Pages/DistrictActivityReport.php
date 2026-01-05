<?php

namespace App\Filament\Pages;

use UnitEnum;

use BackedEnum;
use Filament\Tables;
use App\Models\District;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\ActivityReport;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Filters\Filter;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\View\View;

class DistrictActivityReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $navigationLabel = 'District Activity Report';
    protected string $view = 'filament.pages.district-activity-report';

    protected static ?string $title = 'District Activity Report';


    protected static string|UnitEnum|null $navigationGroup = 'Head Reports';


    public $districts;

    public function mount()
    {
        // Load districts with their activity reports
        $this->districts = District::with('activityReports.task')->get();
        // $this->districts = District::with('district.activityReports')->get();



    }
    // public function render(): View
    // {
    //     return view('filament.pages.district-activity-report');
    // }

    // public static function canAccess(): bool
    // {
    //     return true; // makes it public
    // }
}
