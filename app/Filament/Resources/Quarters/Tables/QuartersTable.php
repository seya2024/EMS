<?php

namespace App\Filament\Resources\Quarters\Tables;

use Filament\Tables\Table;
use Andegna\DateTimeFactory;
use App\Helpers\CalendarHelper;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ForceDeleteBulkAction;



class QuartersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Quarter Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->formatStateUsing(fn($state) => CalendarHelper::isInCurrentQuarter($state)
                        ? '✅ ' . CalendarHelper::gcToEc($state)
                        : CalendarHelper::gcToEc($state))
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->formatStateUsing(fn($state) => CalendarHelper::gcToEc($state))
                    ->sortable(),


                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
