<?php

namespace App\Filament\Resources\FixedLines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;


class FixedLinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('serviceNo')
                    ->label('Service Number')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('account')
                    ->label('Account')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('branch')
                    ->label('Branch')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('media')
                    ->label('Media')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('remark')
                    ->label('Remark')
                    ->limit(50), // truncate long remarks

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(), //->button()->outlined(),
                EditAction::make(), //->button()->outlined(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
