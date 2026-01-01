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



    public function boot(): void
    {
        // Filament::authenticateUsing(function ($request) {
        //     $user = User::where('email', $request->email)->first();

        //     if ($user) {
        //         if (!Hash::check($request->password, $user->password)) {
        //             return null; // wrong password
        //         }

        //         if (!$user->isActive) {
        //             throw ValidationException::withMessages([
        //                 'email' => 'Your account is inactive. Contact System administrator.',
        //             ]);
        //         }

        //         return $user;
        //     }

        //     return null;
        // });
    }
}
