<?php

namespace App\Filament\Resources\OUS\Pages;

use App\Filament\Resources\OUS\OUResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOU extends EditRecord
{
    protected static string $resource = OUResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
