<?php

namespace App\Filament\Resources\Districts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class DistrictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('serial')
                    ->label('#')
                    ->getStateUsing(fn($record, $column) => $column->getTable()->getRecords()->search($record) + 1)
                    ->sortable(false),


                TextColumn::make('name')->label('District Name')->searchable(),
                TextColumn::make('no_of_branch')
                    ->label('No of Branches')
                    ->getStateUsing(fn($record) => $record->branches()->count() - 1),


                TextColumn::make('no_of_atms')
                    ->label('No of ATMs')
                    ->getStateUsing(function ($record) {
                        // $record is the District instance
                        return $record->branches()
                            ->withCount('atms')
                            ->get()
                            ->sum('atms_count');
                    }),

                // POS count
                TextColumn::make('pos_count')
                    ->label('No of POS')
                    ->getStateUsing(function ($record) {
                        return $record->branches()
                            ->withCount('posDevices')
                            ->get()
                            ->sum('pos_devices_count');
                    }),

                // DOB count
                TextColumn::make('dob_count')
                    ->label('No of DOBs')
                    ->getStateUsing(function ($record) {
                        return $record->branches()
                            ->withCount('dobs')
                            ->get()
                            ->sum('dobs_count');
                    }),

                // Dongle count
                TextColumn::make('dongle_count')
                    ->label('No of Dongles')
                    ->getStateUsing(function ($record) {
                        return $record->branches()
                            ->withCount('dongles')
                            ->get()
                            ->sum('dongles_count');
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->rateLimit(5)->rateLimitedNotificationTitle('Slow down!')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
