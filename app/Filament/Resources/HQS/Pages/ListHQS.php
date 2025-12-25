<?php

namespace App\Filament\Resources\HQS\Pages;

use App\Filament\Resources\HQS\HQResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHQS extends ListRecords
{
    protected static string $resource = HQResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->createAnother(false)
        ];
    }
}
