<?php

namespace App\Filament\Exports;

use App\Models\Computer;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;


class ComputerExporter extends Exporter
{
    protected static ?string $model = Computer::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('hardwareType'),
            ExportColumn::make('pcModel'),
            ExportColumn::make('tagNo'),
            ExportColumn::make('serialNo'),
            ExportColumn::make('harddiskSize'),
            ExportColumn::make('ramSize'),
            ExportColumn::make('speed'),
            ExportColumn::make('quantity'),
            ExportColumn::make('unit'),
            ExportColumn::make('price')->state(function (Computer $record): float {
                return $record->amount * (1 + $record->vat_rate);
            }),
            ExportColumn::make('os'),
            ExportColumn::make('isActivated'),
            ExportColumn::make('branch.name'),
            ExportColumn::make('IpAddress'),
            ExportColumn::make('hostName')->listAsJson(), // list multiple value in a cell
            ExportColumn::make('status')->words(10), // the no of words
            ExportColumn::make('created_at')->limit(50), //omit the the lingth of trxt
            ExportColumn::make('updated_at')->enabledByDefault(false),

            //ExportColumn::make('author.name') display data from relationship
            // ExportColumn::make('users_count')->counts('users')  // counting relationships

            //         ExportColumn::make('users_count')>counts([
            //         'users' => fn (Builder $query) => $query->where('is_active', true),
            // ])
            // ExportColumn::make('users_exists')->exists('users')

            // ExportColumn::make('users_avg_age')->avg('users', 'age')  // Aggregating relationships

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your computer export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
