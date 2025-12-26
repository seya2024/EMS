<?php

namespace App\Filament\Resources\Computers\Tables;

use App\Models\Computer;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class ComputersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hardwareType')->label('Hardware Type')->searchable()->sortable(),
                TextColumn::make('pcModel')->label('PC Model')->searchable()->sortable(),
                TextColumn::make('tagNo')->label('Tag Number')->searchable()->sortable(),
                TextColumn::make('serialNo')->label('Serial Number'),
                TextColumn::make('harddiskSize')->label('Hard Disk Size'),
                TextColumn::make('ramSize')->label('RAM Size'),
                TextColumn::make('speed')->label('Processor Speed'),
                TextColumn::make('os')->label('Operating System')->searchable()->sortable(),

                //  TextColumn::make('quantity')->label('Quantity'),
                //  TextColumn::make('unit')->label('Unit'),
                //  TextColumn::make('price')->label('Asset Price')->money('ETB', true),

                // TextColumn::make('isActivated')
                //     ->label('Activated')
                //     ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
                TextColumn::make('branch')
                    ->label('Ownership')  //District - Branch
                    ->getStateUsing(
                        fn($record) =>
                        "{$record->branch?->name} - {$record->branch?->district?->name}"
                    ),

                TextColumn::make('hostName')->label('Host Name'),
                // TextColumn::make('owner')->label('Working Unit')->searchable()->sortable(),
                TextColumn::make('status')->label('Status')->searchable()->sortable(),
                // TextColumn::make('created_at')->label('Created At')->dateTime(),
                // TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])->defaultSort('id', 'desc')

            //->sortable()->searchable(isIndividual: true, isGlobal: false),
            ->filters([]) //->icon(Heroicon::Funnel)

            ->recordActions([

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()->rateLimit(5)->rateLimitedNotification(
                        fn(TooManyRequestsException $exception): Notification => Notification::make()
                            ->warning()
                            ->title('Slow down!')
                            ->body("You can try deleting again in {$exception->secondsUntilAvailable} seconds."),
                    )
                ]),
            ])



            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
