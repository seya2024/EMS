<?php

namespace App\Filament\Resources\HardwareTypes\Pages;

use App\Filament\Resources\HardwareTypes\HardwareTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHardwareType extends EditRecord
{
    protected static string $resource = HardwareTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
