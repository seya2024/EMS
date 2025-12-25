<?php

namespace App\Filament\Resources\DowntimeReasons\Pages;

use App\Filament\Resources\DowntimeReasons\DowntimeReasonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDowntimeReason extends EditRecord
{
    protected static string $resource = DowntimeReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
