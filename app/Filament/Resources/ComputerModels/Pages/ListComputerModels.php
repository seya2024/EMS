<?php

namespace App\Filament\Resources\ComputerModels\Pages;

use App\Filament\Resources\ComputerModels\ComputerModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComputerModels extends ListRecords
{
    protected static string $resource = ComputerModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
