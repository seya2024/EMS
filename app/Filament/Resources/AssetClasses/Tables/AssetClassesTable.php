<?php

namespace App\Filament\Resources\AssetClasses\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class AssetClassesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')->label('District Name')->searchable(),
                TextColumn::make('description')->label('description'),
                TextColumn::make('Created_at')->label('Created at'),
                TextColumn::make('updated_at')->label('Updated at'),
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
