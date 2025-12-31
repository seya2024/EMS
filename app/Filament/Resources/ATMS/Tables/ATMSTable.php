<?php

namespace App\Filament\Resources\ATMS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class ATMSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('custodian.name')
                    ->label('Custodian')
                    ->sortable()
                    ->searchable(),


                TextColumn::make('terminal')
                    ->label('Terminal')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('os')
                    ->label('OS')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Location')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('design')
                    ->label('Design')
                    ->sortable()
                    ->searchable(),



                TextColumn::make('remark')
                    ->label('Remark')
                    ->limit(50), // show first 50 chars

                // TextColumn::make('created_at')
                //     ->label('Created')
                //     ->dateTime()
                //     ->sortable(),

                // TextColumn::make('updated_at')
                //     ->label('Updated')
                //     ->dateTime()
                //     ->sortable(),
            ])
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
