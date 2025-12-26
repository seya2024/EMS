<?php

namespace App\Filament\Resources\OUS\Pages;

use App\Filament\Resources\OUS\OUResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOUS extends ListRecords
{
    protected static string $resource = OUResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
