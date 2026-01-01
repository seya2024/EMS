<?php

namespace App\Filament\Resources\OtherAssets\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class OtherAssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset_number')
                    ->label('Asset No')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('assetClass.name')
                    ->label('Asset Class')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('branch.name')
                    ->label('Branch')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('cost_center')
                    ->label('Cost Center')
                    ->toggleable(),

                TextColumn::make('asset_cost')
                    ->label('Asset Cost')
                    ->money('ETB', true)
                    ->sortable(),

                TextColumn::make('depreciation_current_year')
                    ->label('Depreciation (CY)')
                    ->money('ETB', true),

                TextColumn::make('assigned_to')
                    ->label('Assigned To')
                    ->toggleable(),

                BadgeColumn::make('created_at')
                    ->label('Created')
                    ->date()
                    ->color('gray'),
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
