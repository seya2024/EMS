<?php

namespace App\Filament\Resources\OUS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class OUSTable
{

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('description')->label('Description'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),   // View single photocopier
                EditAction::make(),   // Edit photocopier
                DeleteAction::make(), // Delete photocopier
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(), // Bulk delete
                ]),
            ])->defaultSort('id', 'desc');
    }
}
