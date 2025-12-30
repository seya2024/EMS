<?php

namespace App\Filament\Resources\TaskCategories\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class TaskCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Category Name')->sortable()->searchable(),
                TextColumn::make('description')->label('Description'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),   // View single task category
                EditAction::make(),   // Edit task category
                DeleteAction::make(), // Delete task category
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(), // Bulk delete
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
