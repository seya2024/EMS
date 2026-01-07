<?php

namespace App\Filament\Resources\AssetDisposals\Schemas;

use App\Models\User;
use App\Models\Branch;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class AssetDisposalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Asset Type
                Select::make('asset_type')
                    ->label('Asset Type')
                    ->options([
                        'Computer' => 'Computer',
                        'Printer' => 'Printer',
                        'Scanner' => 'Scanner',
                        'POS' => 'POS',
                        'ATM' => 'ATM',
                        'OtherAsset' => 'Other Asset',
                    ])
                    ->required(),

                // Asset ID
                TextInput::make('asset_id')
                    ->label('Asset ID')
                    ->numeric()
                    ->required(),

                // Branch
                Select::make('branch_id')
                    ->label('Branch')
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->required(),

                // Disposal Reason
                Textarea::make('disposal_reason')
                    ->label('Disposal Reason')
                    ->rows(3)
                    ->required(),

                // Disposed By
                Select::make('disposed_by')
                    ->label('Disposed By')
                    ->options(User::all()->pluck('name', 'id'))
                    ->default(fn() => \Filament\Facades\Filament::auth()->id())
                    ->required(),

                // Disposed At
                DateTimePicker::make('disposed_at')
                    ->label('Disposed At')
                    ->default(fn() => now())
                    ->required(),
            ]);
    }
}
