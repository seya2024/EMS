<?php

namespace App\Filament\Resources\ATMReports\Pages;

use App\Filament\Resources\ATMReports\ATMReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListATMReports extends ListRecords
{
    protected static string $resource = ATMReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
