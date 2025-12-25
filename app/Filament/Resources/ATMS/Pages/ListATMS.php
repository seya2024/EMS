<?php

namespace App\Filament\Resources\ATMS\Pages;

use App\Filament\Resources\ATMS\ATMResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListATMS extends ListRecords
{
    protected static string $resource = ATMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
