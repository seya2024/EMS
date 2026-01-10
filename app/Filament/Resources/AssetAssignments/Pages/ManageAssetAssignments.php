<?php

namespace App\Filament\Resources\AssetAssignments\Pages;

use App\Filament\Resources\AssetAssignments\AssetAssignmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAssetAssignments extends ManageRecords
{
    protected static string $resource = AssetAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
