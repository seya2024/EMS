<?php

namespace App\Filament\Resources\AssetClasses\Pages;

use App\Filament\Resources\AssetClasses\AssetClassResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAssetClass extends EditRecord
{
    protected static string $resource = AssetClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
