<?php

namespace App\Filament\Resources\DataVPNS\Pages;

use App\Filament\Resources\DataVPNS\DataVPNResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDataVPN extends EditRecord
{
    protected static string $resource = DataVPNResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
