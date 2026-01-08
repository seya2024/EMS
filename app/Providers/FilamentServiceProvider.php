<?php

namespace App\Providers;

use App\Filament\Pages\Home;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

// Add this import for your chatbox
use App\Http\Livewire\ChatBox;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function pages(): array
    {
        return [
            Home::class, // <-- register your page here
        ];
    }



    public function boot(): void {}
}
