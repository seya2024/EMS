<?php

namespace App\Filament\Resources\Photocopiers\Pages;

use App\Filament\Resources\Photocopiers\PhotocopierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPhotocopiers extends ListRecords
{
    protected static string $resource = PhotocopierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->createAnother(false)
        ];
    }
}
