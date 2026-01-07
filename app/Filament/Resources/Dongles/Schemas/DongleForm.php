<?php

namespace App\Filament\Resources\Dongles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Models\HQ;
use App\Models\District;
use App\Models\Branch;

class DongleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model')
                    ->label('Model')
                    ->required()
                    ->maxLength(255),

                TextInput::make('serial')
                    ->label('Serial Number')
                    ->required()
                    ->maxLength(100),

                TextInput::make('imei')
                    ->label('IMEI')
                    ->required()
                    ->maxLength(50),

                TextInput::make('iccid')
                    ->label('ICCID')
                    ->required()
                    ->maxLength(50),

                TextInput::make('service_no')
                    ->label('Service Number')
                    ->required()
                    ->maxLength(50),

                Select::make('branch_id')
                    ->label('Branch')
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),


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

                Select::make('network_type')
                    ->label('Network Type')
                    ->options([
                        '2G' => '2G',
                        '3G' => '3G',
                        '4G' => '4G',
                        '5G' => '5G',
                    ])
                    ->required(),

                TextInput::make('value')
                    ->label('Value')
                    ->required()
                    ->numeric(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'blocked' => 'Blocked',
                    ])
                    ->required(),


            ]);
    }
}
