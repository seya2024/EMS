<?php

namespace App\Filament\Resources\Computers\Tables;

use App\Models\Branch;
use App\Models\Computer;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;


use Filament\Tables\Filters\SelectFilter;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;


class ComputersTable
{
    public static function configure(Table $table): Table
    {

        // dd(Filament::auth()->user()->branch_id);

        $userDistrictId = Filament::auth()->user()->branch?->district_id;

        return $table
            ->query(fn($query) => Computer::whereHas(
                'branch',
                fn($q) =>
                $q->where('district_id', $userDistrictId)
            ))

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
                BulkAction::make('handover')
                    ->label('Transfer Selected')
                    ->icon('heroicon-o-hand-raised')
                    ->requiresConfirmation()
                    ->form([
                        Select::make('branch_id')
                            ->label('Select Branch')
                            ->options(\App\Models\Branch::all()->pluck('name', 'id'))
                            ->required(),
                    ])
                    ->action(function (\Illuminate\Support\Collection $records, array $data) {
                        foreach ($records as $records) {
                            $records->update([
                                'branch_id' => $data['branch_id'],
                                'handover_by' => Filament::auth()->id(),
                                'handover_at' => now(),
                            ]);
                        }
                    })
                    ->successNotification(
                        fn(array $data) => Notification::make()
                            ->title('Handing over to ' . Branch::find($data['branch_id'])->name . ' is done!!')
                            ->success()
                    )
                    ->color('warning'),


                /* ================= Disposal ================= */
                BulkAction::make('dispose')
                    ->label('Dispose Selected')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('reason')
                            ->label('Disposal Reason')
                            ->required(),
                    ])
                    ->action(function (\Illuminate\Support\Collection $records, array $data) {
                        foreach ($records as $record) {
                            $record->update([
                                'status' => 'Disposed',
                                'branch_id' => null,
                                'disposed_by' => Filament::auth()->id(),
                                'disposed_at' => now(),
                                'disposal_reason' => $data['reason'],
                            ]);
                        }
                    })
                    ->successNotification(
                        Notification::make()
                            ->title('Selected items have been disposed successfully')
                            ->success()
                    ),

            ])->defaultSort('id', 'desc');
    }
}
