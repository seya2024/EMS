<?php

namespace App\Filament\Resources\HQS\Pages;

use App\Filament\Resources\HQS\HQResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHQ extends EditRecord
{
    protected static string $resource = HQResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
