<?php

namespace App\Filament\Resources\AssetMaintenances\Tables;

use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Collection;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class AssetMaintenancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Only fetch CLOSED maintenance requests
            ->modifyQueryUsing(
                fn(Builder $query) =>
                $query->where('status', 'SENT')
            )
            ->columns([
                // TextColumn::make('assetable_type')
                //     ->label('Asset Type')
                //     ->formatStateUsing(fn($state) => class_basename($state))
                //     ->sortable(),


                // TextColumn::make('assetable.tag')
                //     ->label('Asset Tag')
                //     ->sortable(),

                TextColumn::make('assetable_type')
                    ->label('Asset Tag')
                    ->formatStateUsing(fn($state, $record) => $record->assetable?->display_name ?? '-')
                    ->sortable(),


                TextColumn::make('assetable.branch.name')
                    ->label('Sent from')
                    ->sortable(),


                TextColumn::make('ou.name')
                    ->label('Sent to'),

                TextColumn::make('problem')
                    ->limit(30),


                TextColumn::make('sent_date')
                    ->label('Sent Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                BadgeColumn::make('approval_status')
                    ->label('Approval Status')
                    ->colors([
                        'warning' => 'PENDING',    // Pending → primary color
                        'danger'  => 'REJECTED',   // Rejected → red
                        'success' => 'ACCEPTED',   // Accepted → green
                    ])
                    ->sortable(),

                TextColumn::make('user.full_name')
                    ->label('Sender '),
            ])
            ->defaultSort('sent_date', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn($record) => $record?->branch_id === Filament::auth()->user()?->branch_id
                        && $record?->status !== 'CLOSED'),

                DeleteAction::make()
                    ->visible(fn($record) => $record?->branch_id === Filament::auth()->user()?->branch_id
                        && $record?->status !== 'CLOSED'),
            ])
            ->toolbarActions([

                BulkAction::make('markAccepted')
                    ->label('Mark as Accepted')
                    ->icon('heroicon-s-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            $record->update(['approval_status' => 'ACCEPTED']);
                        }
                    }),

                BulkAction::make('markRejected')
                    ->label('Mark as Rejected')
                    ->icon('heroicon-s-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            $record->update(['approval_status' => 'REJECTED']);
                        }
                    }),

                BulkAction::make('markPending')
                    ->label('Mark as Pending')
                    ->icon('heroicon-s-clock')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        foreach ($records as $record) {
                            $record->update(['approval_status' => 'PENDING']);
                        }
                    }),


                BulkActionGroup::make([
                    // DeleteBulkAction::make()
                    //->visible(fn($record) => $record?->branch_id === Filament::auth()->user()?->branch_id && $record?->status !== 'CLOSED'),
                ]),


            ]);
    }
}
