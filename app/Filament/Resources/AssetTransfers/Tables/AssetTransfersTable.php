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
use App\Models\Branch;
use App\Models\AssetTransfer;

class AssetTransfersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assetable_type')
                    ->label('Asset Tag')
                    ->formatStateUsing(fn($state, $record) => $record->assetable?->display_name ?? '-')
                    ->sortable(),

                TextColumn::make('fromBranch.name')->label('From Branch')->sortable()->searchable(),
                TextColumn::make('toBranch.name')->label('To Branch')->sortable()->searchable(),
                BadgeColumn::make('action')
                    ->label('Action')
                    ->colors([
                        'success' => 'transfer',
                        'warning' => 'handover',
                        'primary' => 'takeover',
                        'danger' => 'disposal',
                    ])
                    ->sortable(),
                TextColumn::make('user.full_name')->label('Performed By')->sortable()->searchable(),
                TextColumn::make('performed_at')->label('Performed At')->dateTime()->sortable(),
                TextColumn::make('remarks')->limit(50),
            ])
            ->filters([
                // Optional filters
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    /* ================= Bulk Transfer / Handover ================= */
                    BulkAction::make('handover')
                        ->label('Transfer Selected')
                        ->icon('heroicon-o-hand-raised')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('to_branch_id')
                                ->label('Select Branch')
                                ->options(Branch::all()->pluck('name', 'id'))
                                ->required(),
                            Textarea::make('remarks')->label('Remarks')->maxLength(250),
                        ])
                        ->action(function (\Illuminate\Support\Collection $records, array $data) {
                            foreach ($records as $record) {
                                $asset = $record->asset;

                                if (! $asset) {
                                    continue; // skip if no related asset
                                }

                                $asset->update([
                                    'branch_id' => $data['to_branch_id'],
                                ]);

                                AssetTransfer::create([
                                    'asset_type' => get_class($asset),
                                    'asset_id' => $asset->id,
                                    'from_branch_id' => $record->branch_id,
                                    'to_branch_id' => $data['to_branch_id'],
                                    'performed_by' => \Filament\Facades\Filament::auth()->id(),
                                    'performed_at' => now(),
                                    'remarks' => $data['remarks'] ?? null,
                                    'action' => 'transfer',
                                ]);
                            }
                        })
                        ->successNotification(
                            fn(array $data) => Notification::make()
                                ->title('Transfer to ' . Branch::find($data['to_branch_id'])->name . ' completed!')
                                ->success()
                        )
                        ->color('warning'),

                    /* ================= Bulk Disposal ================= */
                    BulkAction::make('dispose')
                        ->label('Dispose Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->form([
                            Textarea::make('reason')->label('Disposal Reason')->required(),
                        ])
                        ->action(function (\Illuminate\Support\Collection $records, array $data) {
                            foreach ($records as $record) {
                                $asset = $record->asset;

                                if (! $asset) {
                                    continue; // skip if no related asset
                                }

                                $asset->update([
                                    'branch_id' => null,
                                    'status' => 'Disposed',
                                    'disposed_by' => \Filament\Facades\Filament::auth()->id(),
                                    'disposed_at' => now(),
                                    'disposal_reason' => $data['reason'],
                                ]);

                                AssetTransfer::create([
                                    'asset_type' => get_class($asset),
                                    'asset_id' => $asset->id,
                                    'from_branch_id' => $record->branch_id,
                                    'to_branch_id' => null,
                                    'performed_by' => \Filament\Facades\Filament::auth()->id(),
                                    'performed_at' => now(),
                                    'remarks' => $data['reason'],
                                    'action' => 'disposal',
                                ]);
                            }
                        })
                        ->successNotification(
                            fn() => Notification::make()
                                ->title('Selected items have been disposed successfully')
                                ->success()
                        ),
                ]),
            ]);
    }
}
