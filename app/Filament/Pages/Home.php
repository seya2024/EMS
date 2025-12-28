<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Support\Facades\Auth;

class Home extends Page
{
    protected string $view = 'filament.pages.home';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Home';
    protected static ?string $slug = 'home';

    // Pass dynamic data to Blade
    protected function getViewData(): array
    {
        return [
            'userName' => Auth::user()?->name ?? 'Guest',
            'today' => now()->format('l, F j, Y'),
        ];
    }
    public function pages(): array
    {
        return [
            Home::class,
        ];
    }
}
