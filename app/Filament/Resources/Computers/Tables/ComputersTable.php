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
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\Concerns\HasAssignReturnActions;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;


class ComputersTable
{

    use HasAssignReturnActions;

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
                TextColumn::make('branch')->label('Cost Center')->getStateUsing(
                    fn($record) => "{$record->branch?->name} - {$record->branch?->district?->name}"
                ),
                TextColumn::make('hostName')->label('Host Name'),
                TextColumn::make('status')->label('Status')->searchable()->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record->isTaken() ? 'Taken' : 'Available')
                    ->color(fn($record) => $record->isTaken() ? 'danger' : 'success')
                    ->sortable(),
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


                /* ================= Bulk Assign ================= */

                BulkAction::make('bulkAssign')
                    ->label('Assign Selected')
                    ->icon('heroicon-o-user')
                    ->color('primary')
                    ->form([
                        Select::make('user_id')
                            ->label('Assign To')
                            ->options(
                                fn() =>
                                \App\Models\User::with('branch')
                                    ->orderBy('fname')
                                    ->get()
                                    ->mapWithKeys(fn($user) => [
                                        $user->id =>
                                        trim("{$user->fname} {$user->mname} {$user->lname}") .
                                            ($user->branch ? " ({$user->branch->name})" : '')
                                    ])
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('condition_out')
                            ->label('Condition Out')
                            ->required(),
                    ])
                    ->action(function (\Illuminate\Support\Collection $records, array $data) {

                        $assigned = 0;
                        $skipped  = 0;

                        foreach ($records as $record) {
                            if ($record->currentAssignment) {
                                $record->assignments()->create([
                                    'user_id'       => $data['user_id'],
                                    'assigned_by'   => Filament::auth()->id(),
                                    'assigned_at'   => now(),
                                    'condition_out' => $data['condition_out'],
                                ]);
                                $assigned++;
                            } else {
                                $skipped++;
                            }
                        }

                        if ($assigned === 0) {
                            Notification::make()
                                ->title('Assignment Failed')
                                ->body('All selected assets are already assigned.')
                                ->danger()
                                ->send();
                            return;
                        }

                        Notification::make()
                            ->title('Assets Assigned')
                            ->body(
                                "Assigned: {$assigned} asset(s)." .
                                    ($skipped ? " Skipped: {$skipped} already assigned." : '')
                            )
                            ->success()
                            ->send();
                    }),
                /* ================= Bulk Return ================= */
                BulkAction::make('bulkReturn')
                    ->label('Return Selected')
                    ->icon('heroicon-o-arrow-left')
                    ->color('info')
                    ->form([
                        TextInput::make('condition_in')
                            ->label('Condition In')
                            ->required(),
                    ])
                    ->action(function (\Illuminate\Support\Collection $records, array $data) {
                        $returned = 0;
                        $skipped  = 0;

                        $users = $records->map(
                            fn($record) =>
                            optional($record->assignments()->latest('assigned_at')->first()?->user)->full_name ?? 'Not Assigned'
                        )->unique()->implode(', ');
                        foreach ($records as $record) {
                            if ($record->currentAssignment) {

                                $record->currentAssignment->update([
                                    'returned_at'  => now(),
                                    'returned_by'  => Filament::auth()->id(),
                                    'condition_in' => $data['condition_in'] ?? null,

                                ]);
                                $returned++;
                            } else {
                                $skipped++;
                            }
                        }

                        Notification::make()
                            ->title('Assets Returned')
                            ->body("Returned: {$returned} asset(s). Skipped: {$skipped}. Users affected: {$users}")
                            ->success()
                            ->send();
                    }),

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
