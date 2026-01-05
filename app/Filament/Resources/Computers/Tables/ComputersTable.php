<?php

namespace App\Filament\Resources\Computers\Tables;

use App\Models\Computer;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ReplicateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;


class ComputersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hardwareType.name')->label('Type')->searchable()->sortable(),
                TextColumn::make('computerModel.name')->label('Model')->sortable()->searchable(),
                TextColumn::make('tagNo')->label('Tag Number')->searchable()->sortable(),
                TextColumn::make('serialNo')->label('Serial Number'),
                TextColumn::make('harddiskSize')->label('Hard Disk Size'),
                TextColumn::make('ramSize')->label('RAM Size'),
                TextColumn::make('speed')->label('Processor Speed'),
                TextColumn::make('os')->label('Operating System')->searchable()->sortable(),
                TextColumn::make('branch')->label('Ownership')->getStateUsing(
                    fn($record) => "{$record->branch?->name} - {$record->branch?->district?->name}"
                ),
                TextColumn::make('hostName')->label('Host Name'),
                TextColumn::make('status')->label('Status')->searchable()->sortable(),
            ])->defaultSort('id', 'desc')

            //->sortable()->searchable(isIndividual: true, isGlobal: false),
            ->filters([]) //->icon(Heroicon::Funnel)

            ->recordActions([

                ActionGroup::make([
                    ViewAction::make()->successNotificationTitle('Data View'),
                    EditAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                    ReplicateAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),

                    DeleteAction::make()->rateLimit(5)->rateLimitedNotification(
                        fn(TooManyRequestsException $exception): Notification => Notification::make()
                            ->warning()
                            ->title('Slow down!')
                            ->body("You can try deleting again in {$exception->secondsUntilAvailable} seconds."),
                    )->visible(fn() => Filament::auth()->user()?->role === 'admin'),

                ]),
            ])



            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
