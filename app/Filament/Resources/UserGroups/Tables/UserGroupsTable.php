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
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;

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
                ViewAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                EditAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                DeleteAction::make()->rateLimit(5)->rateLimitedNotificationTitle('Slow down!')
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
