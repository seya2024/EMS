<?php

namespace App\Filament\Resources\Computers\Schemas;

use App\Models\Branch;
use App\Models\ComputerModel;
use App\Models\HardwareType;
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
                        // Select::make('hardwareType')
                        //     ->label('Hardware Type')
                        //     ->options([
                        //         'Desktop' => 'Desktop',
                        //         'Laptop' => 'Laptop',
                        //         'Server' => 'Server',
                        //     ])
                        //     ->required(),


                        Select::make('hardware_type_id')
                            ->label('Hardware Type')
                            ->options(HardwareType::all()->pluck('name', 'id'))
                            // ->searchable()
                            // ->reactive() // important for dependency
                            ->required(),

                        Select::make('computer_model_id')
                            ->label('Computer Model')
                            ->options(function ($get) {
                                $hardwareTypeId = $get('hardware_type_id');

                                if (!$hardwareTypeId) {
                                    return ComputerModel::pluck('name', 'id'); // all models if nothing selected
                                }

                                return ComputerModel::where('hardware_type_id', $hardwareTypeId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->required(),


                        TextInput::make('tagNo')
                            ->label('Tag Number')->placeholder('such as DB/JDO/4.1/4546')
                            ->required(),

                        // TextInput::make('quantity')
                        //     ->label('Quantity')
                        //     ->numeric()
                        //     ->required(),

                        Select::make('isActiveAntivirus')
                            ->label('Is Antivirus Active ?')
                            ->options([
                                'Active Agent' => 'Yes, Agent is Active',
                                'DataBase outdated' => 'DataBase outdated',
                                'Licenced expiered' => 'Licenced expiered',
                                'Licenced expiered' => 'Licenced expiered',


                            ])->required(),


                        TextInput::make('serialNo')
                            ->label('Serial Number')
                            ->required(),



                        Select::make('harddiskSize')
                            ->label('Hard drive Size')
                            ->options([
                                '500GB' => '500  Giga Byte(GB)',
                                '1TB' => '1 Tera Byte(TB)',
                                '250GB' => '250  Giga Byte(GB)',
                                '750GB' => '750 Giga Byte(GB)',

                            ])->searchable()->required(),

                        Select::make('ramSize')
                            ->label('RAM Size in GB such as 4GB or 8GB')
                            ->options([
                                '2GB' => '2 Giga Byte(GB)',
                                '4GB' => '4 Giga Byte(GB)',
                                '6GB' => '6 Giga Byte(GB)',
                                '8GB' => '8 Giga Byte(GB)',
                                '16GB' => '16 Giga Byte(GB)',


                            ])->searchable()->required(),
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
                                'Windows7' => 'Windows 7',
                                'Windows8' => 'Windows 8',
                                'Windows10' => 'Windows 10',
                                'Windows11' => 'Windows 11',
                            ])
                            ->required(),

                        Select::make('isActivated')
                            ->label(' OS Activated ?')
                            ->options([
                                1 => 'Yes',
                                0 => 'No',
                            ])
                            ->required(),

                        TextInput::make('IpAddress')
                            ->label('IP Address')
                            ->required(),

                        TextInput::make('hostName')
                            ->label('Host Name')->placeholder('such as W-BRN-JDO-4744')
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


                        // TextInput::make('price')
                        //     ->label('Price')
                        //     ->numeric()
                        //     ->rule('decimal:0,2')
                        //     ->prefix('ETB')
                        //     ->required(),

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
