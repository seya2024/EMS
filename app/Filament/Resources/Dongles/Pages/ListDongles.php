<?php

namespace App\Filament\Resources\Dongles\Pages;

use App\Filament\Resources\Dongles\DongleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDongles extends ListRecords
{
    protected static string $resource = DongleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
