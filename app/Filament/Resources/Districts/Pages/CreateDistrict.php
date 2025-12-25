<?php

namespace App\Filament\Resources\Districts\Pages;

use App\Filament\Resources\Districts\DistrictResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateDistrict extends CreateRecord
{
    protected static string $resource = DistrictResource::class;

    // // This runs after a record is successfully created
    // protected function afterCreate(): void
    // {
    //     Notification::make()
    //         ->title(' Record created successfully')
    //         ->success()   // type of flash message
    //         ->send();
    // }
}
