<?php

namespace App\Filament\Resources\Dobs\Pages;

use App\Filament\Resources\Dobs\DobResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDobs extends ListRecords
{
    protected static string $resource = DobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
