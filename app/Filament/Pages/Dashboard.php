<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class Dashboard extends Page
{
    protected  string $view = 'filament.pages.dashboard';


    // Sidebar label
    protected static ?string $navigationLabel = 'Home';

    // Sidebar icon


    //protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;
    // protected static string|Heroicon|null $navigationIcon = Heroicon::Outline('home');

    // Position in the sidebar (lower = top)
    protected static ?int $navigationSort = 100;


    // Optional: default data for view
    // public function mount(): void
    // {
    //     $this->defaultValue = 'Welcome to your home';
    // }
}
