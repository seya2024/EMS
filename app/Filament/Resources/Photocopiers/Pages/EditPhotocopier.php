<?php

namespace App\Filament\Resources\Photocopiers\Pages;

use App\Filament\Resources\Photocopiers\PhotocopierResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPhotocopier extends EditRecord
{
    protected static string $resource = PhotocopierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
