<?php

namespace App\Filament\Resources\ComputerModels\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class ComputerModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Model')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('hardwareType.name')
                    ->limit(40)
                    ->wrap(),


                TextColumn::make('computers_count')
                    ->counts('computers')
                    ->label('Computers'),


                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(), //->button()->outlined(),
                EditAction::make(), //->button()->outlined(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
            ])->defaultSort('id', 'desc');
    }
}
