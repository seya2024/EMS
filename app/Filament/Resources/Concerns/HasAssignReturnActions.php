<?php


namespace App\Filament\Resources\Concerns;

use Filament\Forms;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;

trait HasAssignReturnActions
{
    public static function assignAction(): Action
    {
        return Action::make('assign')
            ->label('Assign')
            ->visible(fn($record) => $record->currentAssignment === null)
            ->form([
                Forms\Components\Select::make('user_id')
                    ->relationship('users', 'name')
                    ->required(),

                TextInput::make('condition_out')
                    ->label('Condition Out')
                    ->required(),
            ])
            ->action(function ($record, array $data) {
                $record->assignments()->create([
                    'user_id'      => $data['user_id'],
                    'assigned_by'  => Filament::auth()->id(),
                    'assigned_at'  => now(),
                    'condition_out' => $data['condition_out'],
                ]);
            });
    }

    public static function returnAction(): Action
    {
        return Action::make('return')
            ->label('Return')
            ->visible(fn($record) => $record->currentAssignment !== null)
            ->form([
                TextInput::make('condition_in')
                    ->label('Condition In')
                    ->required(),
            ])
            ->action(function ($record, array $data) {
                $record->currentAssignment->update([
                    'returned_at'  => now(),
                    'returned_by'  => Filament::auth()->id(),
                    'condition_in' => $data['condition_in'],
                ]);
            });
    }
}
