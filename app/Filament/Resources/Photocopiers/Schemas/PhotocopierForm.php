<?php

namespace App\Filament\Resources\Photocopiers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class PhotocopierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model')
                    ->label('Model')
                    ->required()
                    ->maxLength(255),

                TextInput::make('tag')
                    ->label('Tag')
                    ->required()
                    ->maxLength(100),



                // TextInput::make('quantity')
                //     ->label('Quantity')
                //     ->numeric()           // ensures only numbers
                //     ->required(),

                // Select::make('unit')
                //     ->label('Measurement Unit')
                //     ->options([
                //         'pcs' => 'PCS',
                //         'meter' => 'Meter',
                //         'kg' => 'KG',
                //         'liter' => 'Liter',
                //         'box' => 'Box',
                //         'roll' => 'Roll',
                //         'set' => 'Set',
                //         // add more as needed
                //     ])
                //     ->required(),

                TextInput::make('value')
                    ->label('Value')
                    ->required()
                    ->numeric(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'maintenance' => 'Maintenance',
                        'decommissioned' => 'Decommissioned',
                    ])
                    ->required(),
            ]);
    }
}
