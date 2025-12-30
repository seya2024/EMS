<?php

namespace App\Filament\Imports;

use App\Models\Computer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ComputerImporter extends Importer
{
    protected static ?string $model = Computer::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('hardwareType'),
            ImportColumn::make('pcModel'),
            ImportColumn::make('tagNo'),
            ImportColumn::make('serialNo'),
            ImportColumn::make('harddiskSize'),
            ImportColumn::make('ramSize'),
            ImportColumn::make('speed'),
            // ImportColumn::make('quantity'),
            ImportColumn::make('unit'),
            //ImportColumn::make('price'),
            ImportColumn::make('os'),
            ImportColumn::make('isActivated'),
            ImportColumn::make('IpAddress'),
            ImportColumn::make('hostName'),
            ImportColumn::make('status'),
        ];
    }

    public function resolveRecord(): Computer
    {
        // Primary lookup by serialNo
        return Computer::firstOrNew([
            'serialNo' => $this->data['serialNo'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your computer import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
