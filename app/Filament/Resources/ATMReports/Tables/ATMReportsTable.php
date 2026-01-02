<?php

namespace App\Filament\Resources\ATMReports\Tables;

use Filament\Tables\Table;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;

use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\DateFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use CodeWithKyrian\FilamentDateRange\Tables\Filters\DateRangeFilter;

class ATMReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')
                //     ->label('ID')
                //     ->sortable(),

                TextColumn::make('branch.name') // custodian relation
                    ->label('Custodian')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('atm.terminal') // use relationship atm and column terminal
                    ->label('Terminal'),

                TextColumn::make('downtimeReason.name') // use relationship downtimeReason and column name
                    ->label('Causes for Failure')
                    ->limit(50),

                TextColumn::make('action_taken')
                    ->label('Action Taken')
                    ->limit(50),

                TextColumn::make('down_time_in_days')
                    ->label('Down Time (in Days)'),


                // TextColumn::make('close_date')
                //     ->label('Close Date')
                //     ->date()->default('-'),

                TextColumn::make('call_ID')
                    ->label('Call ID')->default('-'),

                TextColumn::make('TT')
                    ->label('TT')->default('-'),

                TextColumn::make('creator.name') // fetch district
                    ->label('Sys Admin')
                    ->sortable()->default('-'),

                // TextColumn::make('created_at')
                //     ->label('Open date')
                //     ->dateTime()->default('-'),

                TextColumn::make('open_date')
                    ->label('Open Date')
                    ->formatStateUsing(fn($state) => $state
                        ? Carbon::parse($state)->format('d-M-y')
                        : '—'),

                //  IconColumn::make('is_featured')->boolean()

                // IconColumn::make('close_date')
                //     ->boolean()->label('Status')
                //     ->boolean(fn($record) => !is_null($record->close_date)) // only one boolea
                //     ->trueIcon(Heroicon::OutlinedCheckBadge)
                //     ->falseIcon(Heroicon::OutlinedXMark)

                IconColumn::make('status_icon')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record && $record->close_date)
                    ->trueIcon(Heroicon::OutlinedCheckBadge)
                    ->falseIcon(Heroicon::OutlinedXMark)
                    ->colors([
                        'success' => fn($state) => $state,
                        'danger' => fn($state) => !$state,
                    ]),

                TextColumn::make('close_date')
                    ->label('Closed at')
                    ->formatStateUsing(fn($state, $record) => $record && $record->close_date
                        ? $record->close_date->format('d-M-y') : null)
                    ->extraAttributes(['class' => 'ml-1 text-sm text-gray-600']) // small sxt to icon



            ])


            ->filters([
                SelectFilter::make('branch_id')->label('Custodian')->relationship('branch', 'name'),
                SelectFilter::make('atm_id')->label('ATM Terminal')->relationship('atm', 'terminal'),
                SelectFilter::make('downtime_reason_id')->label('Cause for Failure')->relationship('downtimeReason', 'name'),
                SelectFilter::make('creator_id')->label('Sys Admin')->relationship('creator', 'name'),


                // SelectFilter::make('status')
                //     ->label('Status')
                //     ->query(fn($query, $data) => $data === 'open' ? $query->whereNull('close_date') : $query->whereNotNull('close_date'))
                //     ->options([
                //         'open' => 'Open',
                //         'closed' => 'Closed',
                //     ]),



                Filter::make('open_date_range')
                    ->form([
                        DatePicker::make('open_date_from')->label('Start date'),
                        DatePicker::make('open_date_to')->label('End date'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['open_date_from']) {
                            $query->whereDate('open_date', '>=', $data['open_date_from']);
                        }
                        if ($data['open_date_to']) {
                            $query->whereDate('open_date', '<=', $data['open_date_to']);
                        }
                    })
                    ->label('Open Date Range'),

            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make()->visible(fn($record) => is_null($record->close_date))->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                DeleteAction::make()->rateLimit(5)->rateLimitedNotificationTitle('Slow down!')->visible(fn($record) => is_null($record->close_date))->visible(fn() => Filament::auth()->user()?->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
