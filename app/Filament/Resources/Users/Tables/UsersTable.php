<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\Size;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\FontWeight;

class UsersTable
{
    public static function configure(Table $table): Table
    {

        return $table
            ->columns([


                ImageColumn::make('avatar')->label('Photo')
                    ->circular()->grow(false)->getStateUsing(fn($record) => $record && $record->close_date
                        ? asset('images/photo.webp') : asset('images/photo.webp')),

                // TextColumn::make('serial')
                //     ->label('#')
                //     ->getStateUsing(fn($record, $column) => $column->getTable()->getRecords()->search($record) + 1)
                //     ->sortable(false),

                TextColumn::make('full_name')->label('Full Name')
                    ->getStateUsing(fn($record) => trim("{$record->fname} {$record->mname} {$record->lname}"))
                    ->searchable()->weight(FontWeight::Bold),

                TextColumn::make('name')->label('Domain')->searchable(),

                // TextColumn::make('fname')->label('First Name')->searchable(),
                // TextColumn::make('mname')->label('Father Name')->searchable(),
                // TextColumn::make('lname')->label('Last Name')->searchable(),

                TextColumn::make('email')->label('Email address')->searchable()->icon('heroicon-m-envelope'),
                TextColumn::make('phone')->label('Phone')->icon('heroicon-m-phone'),
                TextColumn::make('working_unit')->label('Working Unit'),
                TextColumn::make('role')->label('Role'),
                TextColumn::make('email_verified_at')->dateTime()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])


            ->recordActions([

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()->rateLimit(5)->rateLimitedNotificationTitle('Slow down!')
                ])->label('More actions')->icon('heroicon-m-ellipsis-vertical')->size(Size::Small)->color('info')->button()
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
