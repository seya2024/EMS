<?php

namespace App\Filament\Resources\UserGroups\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class UserGroupsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Group Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),

                TextColumn::make('users_count')
                    ->label('Users')
                    ->counts('users')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('users')
                    ->relationship('users', 'name')
                    ->label('Filter by User'),
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
            ])
            ->defaultSort('id', 'desc');
    }
}
