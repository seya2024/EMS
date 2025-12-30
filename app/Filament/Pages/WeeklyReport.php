<?php

namespace App\Filament\Pages;

use App\Models\ATMReport;
use Filament\Pages\Page;
use UnitEnum;
use App\Models\User;
use App\Models\Task;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class WeeklyReport extends Page
{
    protected static ?string $navigationLabel = 'Weekly Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reportings';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected string $view = 'filament.pages.weekly-report';
    // protected string $view = 'filament.pages.monthly-report';


    protected function getViewData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        return [
            'usersCount' => User::count(),

            'tasksThisWeek' => Task::whereBetween('created_at', [
                $startOfWeek,
                $endOfWeek,
            ])->count(),

            'transactionsTotal' => ATMReport::whereBetween('created_at', [
                $startOfWeek,
                $endOfWeek,
            ])->sum('amount'),
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
