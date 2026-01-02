<?php

namespace App\Filament\Resources\Deliverables\Tables;

use Filament\Tables\Table;
use Filament\Facades\Filament;
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
                ViewAction::make(),
                EditAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                DeleteAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ReplicateAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),

                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
