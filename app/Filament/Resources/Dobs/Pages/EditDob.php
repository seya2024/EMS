<?php

namespace App\Filament\Resources\Dobs\Pages;

use App\Filament\Resources\Dobs\DobResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDob extends EditRecord
{
    protected static string $resource = DobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
