<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Size;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Colors\Color;
use Illuminate\Foundation\Auth\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Support\Facades\FilamentColor;


class UsersTable
{
    public static function configure(Table $table): Table
    {

        return $table
            ->columns([


                ImageColumn::make('avatar')->label('Photo')
                    ->circular()->grow(false)->getStateUsing(fn($record) => $record && $record->close_date
                        ? asset('images/photo.webp') : asset('images/photo.webp')),

                TextColumn::make('serial')
                    ->label('#')
                    ->getStateUsing(fn($record, $column) => $column->getTable()->getRecords()->search($record) + 1)
                    ->sortable(false),

                TextColumn::make('full_name')->label('Full Name')
                    ->getStateUsing(fn($record) => trim("{$record->fname} {$record->mname} {$record->lname}"))
                    ->searchable()->weight(FontWeight::Bold),

                TextColumn::make('name')->label('Domain')->searchable(),

                // TextColumn::make('fname')->label('First Name')->searchable(),
                // TextColumn::make('mname')->label('Father Name')->searchable(),
                // TextColumn::make('lname')->label('Last Name')->searchable(),

                TextColumn::make('email')->label('Email address')->searchable()->icon('heroicon-m-envelope'),
                TextColumn::make('phone')->label('Phone')->icon('heroicon-m-phone'),
                TextColumn::make('branch.name')->label('Working Unit'),
                TextColumn::make('role')->label('Role'),

                ToggleColumn::make('isActive')
                    ->label('Account Status')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),

                TextColumn::make('email_verified_at')->dateTime()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])


            //->authorize(fn ($record) => auth()->user()->can('update', $record)),
            //->authorize(fn ($record) => auth()->user()->can('delete', $record)),


            ->recordActions([

                ActionGroup::make([
                    ViewAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                    EditAction::make(), //->authorize(fn() => auth()->user()->hasGroupPermission($this->getRecord(), 'update')),

                    //->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                    DeleteAction::make()->rateLimit(5)->rateLimitedNotificationTitle('Slow down!')
                ])->label('More actions')->icon('heroicon-m-ellipsis-vertical')->size(Size::Small)->color('info')->button()
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin')
                ]),
            ])->defaultSort('id', 'desc');
    }
}
