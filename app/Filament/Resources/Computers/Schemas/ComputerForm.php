<?php

namespace App\Filament\Resources\Computers\Schemas;

use App\Models\Branch;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard\Step;

class ComputerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                // --------------------
                // STEP 1: Hardware
                // --------------------
                Step::make('Hardware Information')
                    ->schema([
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
                            ->numeric()
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
                    ])
                    ->columns(2),

                // --------------------
                // STEP 2: System Information
                // --------------------
                Step::make('System Information')
                    ->schema([
                        TextInput::make('speed')
                            ->label('Processor Speed')
                            ->required(),

                        Select::make('os')
                            ->label('Operating System')
                            ->options([
                                'Windows 7' => 'Windows 7',
                                'Windows 8' => 'Windows 8',
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
                    ])
                    ->columns(2),

                // --------------------
                // STEP 3: Owner Information
                // --------------------
                Step::make('Owner Information') //->icon(Heroicon::ComputerDesktop)
                    ->schema([


                        Select::make('branch_id')
                            ->label('Branch')
                            ->options(Branch::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),


                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->rule('decimal:0,2')
                            ->prefix('ETB')
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Functional' => 'Functional',
                                'Non-Functional' => 'Non-Functional',
                                'Decommissioned' => 'Decommissioned',
                            ])
                            ->default('Functional')
                            ->required(),
                    ])
                    ->columns(2),
            ])
                ->skippable(false)   // forces step-by-step completion
                ->columnSpanFull(),
        ]);
    }
}
