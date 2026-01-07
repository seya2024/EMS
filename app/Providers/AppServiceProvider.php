<?php

namespace App\Providers;

use App\Models\ATM;
use App\Models\DOB;
use App\Models\Pos;
use App\Models\Dongle;
use App\Models\Printer;

use App\Models\Scanner;
use App\Models\Computer;
use App\Models\Photocopy;
use App\Models\OtherAsset;
use Laravel\Fortify\Fortify;
use Filament\Facades\Filament;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::morphMap([

            'Computer'           => Computer::class,
            'ATM'                => ATM::class,
            'Printer'            => Printer::class,
            'Scanner'            => Scanner::class,
            'Dongle'             => Dongle::class,
            'DOB'                => DOB::class,
            'Photocopy'          => Photocopy::class,
            'POS'                => Pos::class,
            'Non-Digital Asset'  => OtherAsset::class

        ]);



        // Custom validation rule
        // Validator::extend('uppercase', function ($attribute, $value) {
        //     return strtoupper($value) === $value;
        // });


        $this->app->bind(BaseNotification::class, CustomNotification::class);
    }
}
