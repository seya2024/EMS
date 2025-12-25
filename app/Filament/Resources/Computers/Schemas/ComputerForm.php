<?php

namespace App\Filament\Resources\Computers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Models\HQ;
use App\Models\District;
use App\Models\Branch;

class ComputerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('hardwareType')
                    ->label('Hardware Type')
                    ->options([
                        'Desktop' => 'Desktop',
                        'Laptop' => 'Laptop',
                        'Server' => 'Server',
                    ])
                    ->required(),

                TextInput::make('pcModel')
                    ->label('PC Model')
                    ->required(),

                TextInput::make('tagNo')
                    ->label('Tag Number')
                    ->required(),

                TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()           // ensures only numbers
                    ->required(),

                Select::make('unit')
                    ->label('Measurement Unit')
                    ->options([
                        'pcs' => 'PCS',
                        'meter' => 'Meter',
                        'kg' => 'KG',
                        'liter' => 'Liter',
                        'box' => 'Box',
                        'roll' => 'Roll',
                        'set' => 'Set',
                        // add more as needed
                    ])
                    ->required(),

                TextInput::make('serialNo')
                    ->label('Serial Number')
                    ->required(),

                TextInput::make('harddiskSize')
                    ->label('Hard Disk Size')
                    ->required(),

                TextInput::make('ramSize')
                    ->label('RAM Size')
                    ->required(),

                TextInput::make('speed')
                    ->label('Processor Speed')
                    ->required(),

                Select::make('os')
                    ->label('Operating System')
                    ->options([
                        'Windows 7'  => 'Windows 7',
                        'Windows 8'  => 'Windows 8',
                        'Windows 10' => 'Windows 10',
                        'Windows 11' => 'Windows 11',
                    ])
                    ->required(),

                Select::make('isActivated')
                    ->label('Activated')
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])
                    ->required(),

                TextInput::make('IpAddress')
                    ->label('IP Address')
                    ->required(),

                TextInput::make('hostName')
                    ->label('Host Name')
                    ->required(),

                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->rule('decimal:0,2')
                    ->prefix('ETB') // or remove if not needed
                    ->required(),

                // TextInput::make('value')
                //     ->label('Value')
                //     ->required()
                //     ->numeric(),


                // Select::make('owner_select')
                //     ->label('Owner')
                //     ->options(function () {
                //         $options = [];

                //         // HQs
                //         foreach (HQ::all() as $hq) {
                //             $options["HQ:{$hq->id}"] = "HQ - {$hq->name}";
                //         }
                //         // Districts
                //         foreach (District::all() as $district) {
                //             $options["District:{$district->id}"] = "District - {$district->name}";
                //         }
                //         // Branches
                //         foreach (Branch::all() as $branch) {
                //             $options["Branch:{$branch->id}"] = "Branch - {$branch->name}";
                //         }

                //         return $options;
                //     })
                //     ->required()
                //     ->reactive()
                //     ->afterStateUpdated(function ($state, $set) {
                //         [$type, $id] = explode(':', $state);
                //         $set('owner_type', "App\\Models\\$type");
                //         $set('owner_id', $id);
                //     }),

                // Hidden::make('owner_type'),
                // Hidden::make('owner_id'),


                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Functional' => 'Functional',
                        'Non-Functional' => 'Non-Functional',
                        'Decommissioned' => 'Decommissioned', // retired
                    ])
                    ->required()
                    ->default('Functional'), // optional: sets default value
            ]);
    }
}
