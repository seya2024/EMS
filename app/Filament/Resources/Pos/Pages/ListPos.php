<?php

namespace App\Filament\Resources\Pos\Pages;

use App\Filament\Resources\Pos\PosResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPos extends ListRecords
{
    protected static string $resource = PosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->createAnother(false)
        ];
    }
}
