<?php

namespace App\Filament\Resources\Scanners\Pages;

use App\Filament\Resources\Scanners\ScannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScanners extends ListRecords
{
    protected static string $resource = ScannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->createAnother(false)
        ];
    }
}
