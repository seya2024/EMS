<?php

namespace App\Filament\Resources\Pos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model')->label('Model')->sortable()->searchable(),
                TextColumn::make('tag')->label('Tag')->sortable()->searchable(),
                TextColumn::make('serial')->label('Serial')->sortable()->searchable(),
                TextColumn::make('service_no')->label('Service No')->sortable()->searchable(),
                TextColumn::make('type')->label('Type')->sortable(),
                TextColumn::make('merchant')->label('Merchant')->sortable(),
                TextColumn::make('value')->label('Value')->sortable()->searchable(),
                // TextColumn::make('quantity')->label('Quantity'),
                // TextColumn::make('unit')->label('Unit'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),   // View single POS
                EditAction::make(),   // Edit POS
                DeleteAction::make(), // Delete POS
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(), // Bulk delete
                ]),
            ])->defaultSort('id', 'desc');
    }
}
