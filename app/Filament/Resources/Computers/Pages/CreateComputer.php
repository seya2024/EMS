<?php

namespace App\Filament\Resources\Computers\Pages;

use App\Filament\Resources\Computers\ComputerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateComputer extends CreateRecord
{
    protected static string $resource = ComputerResource::class;

    //protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
