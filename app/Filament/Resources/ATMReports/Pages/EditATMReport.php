<?php

namespace App\Filament\Resources\ATMReports\Pages;

use App\Filament\Resources\ATMReports\ATMReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditATMReport extends EditRecord
{
    protected static string $resource = ATMReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
