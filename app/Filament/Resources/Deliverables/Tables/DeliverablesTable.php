<?php

namespace App\Filament\Resources\Deliverables\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ReplicateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class DeliverablesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task.name')->label('Specific Task')->sortable()->searchable(),
                TextColumn::make('outcome')->label('Deliverable outcome')->sortable()->searchable(),
                TextColumn::make('description')->label('Description')->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),      // View single deliverable
                EditAction::make(),      // Edit deliverable
                DeleteAction::make(),    // Delete deliverable
                ReplicateAction::make(), // Clone/replicate deliverable
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),    // Bulk delete

                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
