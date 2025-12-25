<?php

namespace App\Filament\Resources\FixedLines\Pages;

use App\Filament\Resources\FixedLines\FixedLineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFixedLine extends EditRecord
{
    protected static string $resource = FixedLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
