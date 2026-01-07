<?php

namespace App\Filament\Resources\AssetTransfers\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Branch;
use App\Models\AssetTransfer;
use Filament\Facades\Filament;

class AssetTransfersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assetable_type')
                    ->label('Asset')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->assetable?->display_name ?? '-'
                    )
                    ->sortable(),

                TextColumn::make('fromBranch.name')
                    ->label('From Branch')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('toBranch.name')
                    ->label('To Branch')
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('action')
                    ->label('Action')
                    ->colors([
                        'success' => 'transfer',
                        'warning' => 'handover',
                        'primary' => 'takeover',
                        'danger'  => 'disposal',
                    ])
                    ->sortable(),

                TextColumn::make('user.full_name')
                    ->label('Performed By')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('performed_at')
                    ->label('Performed At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('remarks')->limit(50),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                    /* ================= BULK TRANSFER ================= */
                    BulkAction::make('transfer')
                        ->label('Transfer Selected')
                        ->icon('heroicon-o-arrow-right-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('to_branch_id')
                                ->label('Target Branch')
                                ->options(fn() => Branch::pluck('name', 'id'))
                                ->required(),

                            Textarea::make('remarks')
                                ->maxLength(250),
                        ])
                        ->action(function (Collection $records, array $data) {

                            DB::transaction(function () use ($records, $data) {

                                foreach ($records as $record) {

                                    $asset = $record->assetable;

                                    if (! $asset) {
                                        continue;
                                    }

                                    if ($asset->branch_id == $data['to_branch_id']) {
                                        continue;
                                    }

                                    $fromBranch = $asset->branch_id;

                                    $asset->update([
                                        'branch_id' => $data['to_branch_id'],
                                    ]);

                                    AssetTransfer::create([
                                        'assetable_type' => get_class($asset),
                                        'assetable_id'   => $asset->id,
                                        'from_branch_id' => $fromBranch,
                                        'to_branch_id'   => $data['to_branch_id'],
                                        'action'         => 'transfer',
                                        'performed_by'   => Filament::auth()->id(),
                                        'performed_at'   => now(),
                                        'remarks'        => $data['remarks'] ?? null,
                                    ]);
                                }
                            });
                        })
                        ->successNotification(
                            fn(array $data) =>
                            Notification::make()
                                ->success()
                                ->title(
                                    'Transfer completed to ' .
                                        Branch::find($data['to_branch_id'])?->name
                                )
                        ),

                    /* ================= BULK DISPOSAL ================= */
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
                        ->action(function (Collection $records, array $data) {

                            DB::transaction(function () use ($records, $data) {

                                foreach ($records as $record) {

                                    $asset = $record->assetable;

                                    if (! $asset) {
                                        continue;
                                    }

                                    $fromBranch = $asset->branch_id;

                                    $asset->update([
                                        'branch_id'        => null,
                                        'status'           => 'Disposed',
                                        'disposed_by'      => Filament::auth()->id(),
                                        'disposed_at'      => now(),
                                        'disposal_reason'  => $data['reason'],
                                    ]);

                                    AssetTransfer::create([
                                        'assetable_type' => get_class($asset),
                                        'assetable_id'   => $asset->id,
                                        'from_branch_id' => $fromBranch,
                                        'to_branch_id'   => null,
                                        'action'         => 'disposal',
                                        'performed_by'   => Filament::auth()->id(),
                                        'performed_at'   => now(),
                                        'remarks'        => $data['reason'],
                                    ]);
                                }
                            });
                        })
                        ->successNotification(
                            fn() =>
                            Notification::make()
                                ->success()
                                ->title('Selected assets transfered successfully')
                        ),
                ]),
            ]);
    }
}
