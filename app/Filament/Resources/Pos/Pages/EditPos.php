<?php

namespace App\Filament\Resources\Pos\Pages;

use App\Filament\Resources\Pos\PosResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPos extends EditRecord
{
    protected static string $resource = PosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
