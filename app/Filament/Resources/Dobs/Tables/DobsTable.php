<?php

namespace App\Filament\Resources\Dobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model')->label('Model')->sortable()->searchable(),
                TextColumn::make('serial')->label('Serial')->sortable()->searchable(),
                TextColumn::make('imei')->label('IMEI')->sortable()->searchable(),
                TextColumn::make('iccid')->label('ICCID')->sortable()->searchable(),
                TextColumn::make('value')->label('Asset Value')->sortable()->searchable(),
                TextColumn::make('service_no')->label('Service No')->sortable()->searchable(),
                TextColumn::make('network_type')->label('Network Type')->sortable(),
                TextColumn::make('status')->label('Status')->sortable(),
                TextColumn::make('quantity')->label('Quantity'),
                TextColumn::make('unit')->label('Measurement Unit'),
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
            ])->defaultSort('id', 'desc');
    }
}
