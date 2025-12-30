<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Title')->sortable()->searchable(),
                TextColumn::make('description')->label('Description')->limit(50),
                TextColumn::make('taskCategory.name')->label('Category')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),   // View single task
                EditAction::make(),   // Edit task
                DeleteAction::make(), // Delete task
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(), // Bulk delete
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
