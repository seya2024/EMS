<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

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
        //
    }

    // public function boot(): void
    // {
    //     Filament::serving(function () {
    //         Filament::getUserName(function ($user) {
    //             return trim("{$user->fname} {$user->mname} {$user->lname}");
    //         });
    //     });
    // }
}
