<?php

namespace App\Filament\Resources\DataVPNS\Pages;

use App\Filament\Resources\DataVPNS\DataVPNResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDataVPNS extends ListRecords
{
    protected static string $resource = DataVPNResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
