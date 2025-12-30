<?php

namespace App\Filament\Pages;

use UnitEnum;
use App\Models\Task;
use App\Models\User;
use Filament\Pages\Page;
use App\Models\ATMReport;
use App\Models\Transaction;
//use Illuminate\Foundation\Auth\User;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;

class MonthlyReport extends Page
{
    protected static ?string $navigationLabel = 'Monthly Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reportings';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    //protected static string $view = 'filament.pages.monthly-report';
    protected string $view = 'filament.pages.monthly-report';


    protected function getViewData(): array
    {
        return [
            'usersCount' => User::count(),

            'tasksThisMonth' => Task::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            'transactionsTotal' => ATMReport::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ]);
    }
}
