<?php

namespace App\Filament\Resources\OtherAssets\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class OtherAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('asset_class_id')
                    ->label('Asset Class')
                    ->relationship('assetClass', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('asset_number')
                    ->label('Asset Number')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('branch_id')
                    ->label('Branch')
                    ->relationship('branch', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('cost_center')
                    ->label('Cost Center')
                    ->maxLength(50),

                TextInput::make('asset_cost')
                    ->label('Asset Cost')
                    ->numeric()
                    ->prefix('ETB')
                    ->required(),

                TextInput::make('depreciation_current_year')
                    ->label('Depreciation (Current Year)')
                    ->numeric()
                    ->prefix('ETB'),

                TextInput::make('assigned_to')
                    ->label('Assigned To')
                    ->maxLength(100),

                Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }
}
