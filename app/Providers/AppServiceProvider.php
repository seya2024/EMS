<?php

namespace App\Providers;

use Laravel\Fortify\Fortify;
use Filament\Facades\Filament;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification as BaseNotification;;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Custom validation rule
        // Validator::extend('uppercase', function ($attribute, $value) {
        //     return strtoupper($value) === $value;
        // });


        $this->app->bind(BaseNotification::class, CustomNotification::class);
    }
}
