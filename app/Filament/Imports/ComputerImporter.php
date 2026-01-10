<?php

namespace App\Filament\Imports;

use App\Models\Computer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ComputerImporter extends Importer
{
    protected static ?string $model = Computer::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('hardwareType'),
            ImportColumn::make('pc_model_id'),
            ImportColumn::make('tagNo'),
            ImportColumn::make('serialNo'),
            ImportColumn::make('harddiskSize'),
            ImportColumn::make('ramSize'),
            ImportColumn::make('speed'),
            ImportColumn::make('unit'),
            ImportColumn::make('os'),
            ImportColumn::make('isActivated'),
            ImportColumn::make('IpAddress'),
            ImportColumn::make('hostName'),
            ImportColumn::make('status'),
            ImportColumn::make('branch_id'),
        ];
    }
    public function resolveRecord(): Computer
    {
        ///  dd($this->data); // See exactly what data is being imported
        try {
            $record = Computer::firstOrNew(['serialNo' => $this->data['serialNo']]);
            $record->fill($this->data);
            $record->save();
            return $record;
        } catch (\Throwable $e) {
            // Log the failed row and reason
            Log::error('Import failed for serialNo: ' . ($this->data['serialNo'] ?? 'N/A'), [
                'data' => $this->data,
                'error' => $e->getMessage(),
            ]);

            // Throwing here marks the row as failed for Filament
            throw $e;
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your computer import has completed and ' . Number::format($import->successful_rows) . ' ' . Str::plural('row', $import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . Str::plural('row', $failedRowsCount) . ' failed to import.';

            // Optional: List failed rows in notification (for debugging)
            foreach ($import->getFailedRows() as $failedRow) {
                $body .= "\nRow " . $failedRow['row'] . " failed: " . implode(', ', $failedRow['errors'] ?? ['Unknown error']);
            }
        }

        return $body;
    }
}
