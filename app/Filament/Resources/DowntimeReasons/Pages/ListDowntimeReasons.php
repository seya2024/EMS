<?php

namespace App\Filament\Resources\DowntimeReasons\Pages;

use App\Filament\Resources\DowntimeReasons\DowntimeReasonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDowntimeReasons extends ListRecords
{
    protected static string $resource = DowntimeReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
