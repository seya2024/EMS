<?php

namespace App\Filament\Resources\DowntimeReasons\Pages;

use App\Filament\Resources\DowntimeReasons\DowntimeReasonResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDowntimeReason extends CreateRecord
{
    protected static string $resource = DowntimeReasonResource::class;
}
