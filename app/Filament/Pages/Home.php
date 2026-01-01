<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use App\Models\Branch;
use App\Models\Computer;
use App\Models\District;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Home extends Page
{
    protected string $view = 'filament.pages.home';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Home';
    protected static ?string $slug = 'home';

    // Make page accessible to all logged-in users
    protected static ?string $permission = null;
    // Pass dynamic data to Blade
    protected function getViewData(): array
    {
        return [
            'welcomeMessage' => config('app.homepage_welcome'),
            'userName' => Auth::user()?->name ?? 'Guest',
            'today' => now()->format('l, F j, Y'),


            'usersCount' => User::count(),
            'computerCount' => Computer::count(),
            'branchCount' => Branch::count(),
            'districtCount' => District::count(),


        ];
    }
    public function pages(): array
    {
        return [
            Home::class,
        ];
    }
}
