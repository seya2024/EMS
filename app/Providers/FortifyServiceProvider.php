<?php


namespace App\Providers;

use App\Models\User;
use Laravel\Fortify\Fortify;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Filament::authenticateUsing(function ($request) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return null; // wrong password
                }

                if (!$user->isActive) {
                    throw ValidationException::withMessages([
                        'email' => 'Your account is inactive. Contact System administrator.',
                    ]);
                }

                return $user;
            }

            return null;
        });
    }
}
