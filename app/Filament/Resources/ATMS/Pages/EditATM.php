<?php

namespace App\Filament\Resources\ATMS\Pages;

use App\Filament\Resources\ATMS\ATMResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditATM extends EditRecord
{
    protected static string $resource = ATMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
