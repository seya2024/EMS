<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;

class ViewBranch extends ViewRecord
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function getViewContent(): array
    {
        return [
            'Code' => $this->record->code,
            'Name' => $this->record->name,
            'Grade' => $this->record->grade,
            'District' => $this->record->district->name ?? null,
            'Created At' => $this->record->created_at,
            'Updated At' => $this->record->updated_at,
        ];
    }
}
