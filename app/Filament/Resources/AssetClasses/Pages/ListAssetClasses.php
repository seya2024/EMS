<?php

namespace App\Filament\Resources\AssetClasses\Pages;

use App\Filament\Resources\AssetClasses\AssetClassResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssetClasses extends ListRecords
{
    protected static string $resource = AssetClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
