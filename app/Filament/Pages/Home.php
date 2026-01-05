<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use App\Helpers\CalendarHelper;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Computer;
use App\Models\District;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Andegna\DateTime;
use Andegna\DateTimeFactory;

class Home extends Page
{
    protected string $view = 'filament.pages.home';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Home';
    protected static ?string $slug = 'home';

    // Make page accessible to all logged-in users
    protected static ?string $permission = null;

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


    // Pass dynamic data to Blade
    protected function getViewData(): array
    {
        return [
            'welcomeMessage' => config('app.homepage_welcome'),
            'userName' => Auth::user()?->name ?? 'Guest',
            'today' => now()->format('l, F j, Y'),


            // 'usersCount' => User::count(),
            // 'computerCount' => Computer::count(),
            // 'branchCount' => Branch::count(),
            // 'districtCount' => District::count(),


        ];
    }
    public function pages(): array
    {
        return [
            Home::class,
        ];
    }


    // public static function gcToEc(Carbon|string $date)
    //     {

    //          $ecDate = CalendarHelper::gcToEc('2026-01-05'); 


    //         // same code as above]
    //         // $ecDate = Quarter::gcToEc('2026-01-05'); 
    //         //echo $ecDate; // e.g., 2018-04-27
    //     }
    //$ec = Quarter::gcToEc('2026-01-05');
    //function gcToEc($date) { /* code */ }
    //$ec = gcToEc('2026-01-05');
    //$ec = Quarter::gcToEc('2026-01-05');

    //CalendarHelper::gcToEc();

    //  use App\Helpers\CalendarHelper;

    // $ecDate = CalendarHelper::gcToEc('2026-01-05'); 
    // echo $ecDate; // e.g., 2018-04-27 (EC)
    //function gcToEc($date) { }/* code */ }
}
