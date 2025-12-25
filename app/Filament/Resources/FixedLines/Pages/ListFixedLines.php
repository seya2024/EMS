<?php

namespace App\Filament\Resources\FixedLines\Pages;

use App\Filament\Resources\FixedLines\FixedLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFixedLines extends ListRecords
{
    protected static string $resource = FixedLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
