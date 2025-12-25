<?php

namespace App\Filament\Resources\Scanners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ScannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model')->label('Model')->sortable()->searchable(),
                TextColumn::make('tag')->label('Tag')->sortable()->searchable(),
                TextColumn::make('value')->label('Value')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable(),
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
                    DeleteBulkAction::make(), // Bulk delete
                ]),
            ]);
    }
}
