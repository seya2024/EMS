<?php

namespace App\Filament\Resources\Dongles\Pages;

use App\Filament\Resources\Dongles\DongleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDongle extends EditRecord
{
    protected static string $resource = DongleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
