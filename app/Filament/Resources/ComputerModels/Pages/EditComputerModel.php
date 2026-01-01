<?php

namespace App\Filament\Resources\ComputerModels\Pages;

use App\Filament\Resources\ComputerModels\ComputerModelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditComputerModel extends EditRecord
{
    protected static string $resource = ComputerModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
