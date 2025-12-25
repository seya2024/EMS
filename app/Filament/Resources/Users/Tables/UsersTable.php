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

class UsersTable
{
    public static function configure(Table $table): Table
    {

        return $table
            ->columns([


                TextColumn::make('serial')
                    ->label('#')
                    ->getStateUsing(fn($record, $column) => $column->getTable()->getRecords()->search($record) + 1)
                    ->sortable(false),

                TextColumn::make('full_name')->label('Full Name')
                    ->getStateUsing(fn($record) => trim("{$record->fname} {$record->mname} {$record->lname}"))
                    ->searchable(),
                TextColumn::make('name')->label('Domain')->searchable(),

                // TextColumn::make('fname')->label('First Name')->searchable(),
                // TextColumn::make('mname')->label('Father Name')->searchable(),
                // TextColumn::make('lname')->label('Last Name')->searchable(),

                TextColumn::make('email')->label('Email address')->searchable(),
                TextColumn::make('phone')->label('Phone'),
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
