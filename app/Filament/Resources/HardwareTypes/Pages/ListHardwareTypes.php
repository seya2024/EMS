<?php

namespace App\Filament\Resources\HardwareTypes\Pages;

use App\Filament\Resources\HardwareTypes\HardwareTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHardwareTypes extends ListRecords
{
    protected static string $resource = HardwareTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
