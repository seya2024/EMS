<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use App\Models\AtmReport;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class AtmReports extends Page
{
    protected static ?string $title = 'ATM Reports';

    protected string $view = 'filament.pages.atm-reports';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $navigationLabel = 'ATM Report API Test';

    protected static string|UnitEnum|null $navigationGroup = 'Reportings';

    public function sendReports()
    {
        $reports = AtmReport::all(); // adjust query

        // $response = Http::post('https://other-system.com/api/receive-reports', [
        // HttpClient::post('https://other-system.com/api/receive-reports')
        $response = Http::post('https://ju.edu.et/api/receive-reports', [
            'reports' => $reports,
        ]);

        if ($response->successful()) {
            Notification::make()
                ->title('Reports sent successfully!')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Failed to send reports')
                ->danger()
                ->body($response->body())
                ->send();
        }
    }
}
