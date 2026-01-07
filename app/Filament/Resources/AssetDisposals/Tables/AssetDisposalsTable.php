<?php

namespace App\Filament\Resources\AssetDisposals\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class AssetDisposalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset_type')->label('Asset Type'),
                TextColumn::make('asset.id')->label('Asset ID'),
                TextColumn::make('branch.name')->label('Branch'),
                TextColumn::make('reason')->limit(30),
                TextColumn::make('disposer.name')->label('Disposed By'),
                TextColumn::make('disposed_at')->dateTime(),
            ])
            ->filters([
                //
            ])->defaultSort('disposed_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
