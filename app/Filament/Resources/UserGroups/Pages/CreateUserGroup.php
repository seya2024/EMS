<?php

namespace App\Filament\Resources\UserGroups\Pages;

use App\Filament\Resources\UserGroups\UserGroupResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUserGroup extends CreateRecord
{
    protected static string $resource = UserGroupResource::class;


    protected function getCreatedNotification(): ?Notification
    {
        return parent::getCreatedNotification();
    }
}
