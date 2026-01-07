<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class BranchInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ========= Branch ========= */
                // Section::make('Branch Information')
                //     ->schema([
                //         TextEntry::make('name')->extraAttributes(['class' => 'text-sm']),
                //         TextEntry::make('code')->extraAttributes(['class' => 'text-sm']),
                //         TextEntry::make('tag')->extraAttributes(['class' => 'text-sm']),
                //         TextEntry::make('distric.name')->extraAttributes(['class' => 'text-sm']),
                //         TextEntry::make('grade')->extraAttributes(['class' => 'text-sm']),
                //     ])->collapsed()
                //     ->columns(5),

                /* ========= Computers ========= */
                Section::make('Computers')
                    ->label(fn($record) => 'Computers (' . $record->computers->count() . ')')
                    ->schema([
                        RepeatableEntry::make('computers')
                            ->schema([
                                TextEntry::make('tagNo')->extraAttributes([
                                    'style' => 'font-size: 0.75rem;', // 12px
                                ]),
                                TextEntry::make('serialNo')->extraAttributes([
                                    'style' => 'font-size: 0.75rem;', // 12px
                                ]),
                                TextEntry::make('os')->extraAttributes([
                                    'style' => 'font-size: 0.75rem;', // 12px
                                ]),
                                TextEntry::make('ramSize')->extraAttributes([
                                    'style' => 'font-size: 0.75rem;', // 12px
                                ]),
                                TextEntry::make('status')->extraAttributes([
                                    'style' => 'font-size: 0.75rem;', // 12px
                                ]),
                            ])
                            ->columns(5),
                    ])
                    ->collapsed(),



                /* ========= Printers ========= */
                Section::make('Printers')
                    ->label(fn($record) => 'Printers (' . $record->Printers->count() . ')')
                    ->schema([
                        RepeatableEntry::make('printers')
                            ->schema([
                                TextEntry::make('model')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('tag')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('status')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(3),
                    ])
                    ->collapsed(),

                /* ========= POS ========= */
                Section::make('POS Devices')

                    ->label(fn($record) => 'POS Devices (' . $record->posDevices->count() . ')')

                    ->schema([

                        RepeatableEntry::make('posDevices')
                            ->schema([
                                TextEntry::make('model')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('tag')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('serial')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('merchant')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(4),
                    ])
                    ->collapsed(),

                /* ========= ATMs ========= */
                Section::make('ATMs')
                    ->label(fn($record) => 'ATMs (' . $record->atms->count() . ')')
                    ->schema([
                        RepeatableEntry::make('atms')
                            ->schema([
                                TextEntry::make('terminal')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('os')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('type')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('location')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(4),
                    ])
                    ->collapsed(),

                /* ========= Data VPN ========= */
                Section::make('Data VPN')
                    ->label(fn($record) => 'Data VPN (' . $record->dataVpns->count() . ')')
                    ->schema([
                        RepeatableEntry::make('dataVpns')
                            ->schema([
                                TextEntry::make('serviceNo')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('lANIp')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('wanIp')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('bandwidth')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(4),
                    ])
                    ->collapsed(),

                /* ========= Dongles ========= */
                Section::make('Dongles')
                    ->label(fn($record) => 'Dongles (' . $record->dongles->count() . ')')
                    ->schema([
                        RepeatableEntry::make('dongles')
                            ->schema([
                                TextEntry::make('model')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('serial')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('imei')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('status')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(4),
                    ])
                    ->collapsed(),

                /* ========= DOB ========= */
                Section::make('DOBs')
                    ->label(fn($record) => 'DOBs (' . $record->dobs->count() . ')')
                    ->schema([
                        RepeatableEntry::make('dobs')
                            ->schema([
                                TextEntry::make('model')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('serial'),
                                TextEntry::make('service_no')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('status')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(4),
                    ])
                    ->collapsed(),

                /* ========= Fixed Lines ========= */
                Section::make('Fixed Lines')
                    ->label(fn($record) => 'Fixed Lines (' . $record->fixedLines->count() . ')')
                    ->schema([
                        RepeatableEntry::make('fixedLines')
                            ->schema([
                                TextEntry::make('serviceNo')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('account')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('media')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(3),
                    ])
                    ->collapsed(),

                /* ========= Other Assets ========= */
                Section::make('Other Assets')

                    ->label(fn($record) => 'Other Assets (' . $record->otherAssets->count() . ')')

                    ->schema([
                        RepeatableEntry::make('otherAssets')
                            ->schema([
                                TextEntry::make('asset_number')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('asset_cost')->extraAttributes(['class' => 'text-sm']),
                                TextEntry::make('assigned_to')->extraAttributes(['class' => 'text-sm']),
                            ])
                            ->columns(3),
                    ])
                    ->collapsed(),





            ]);
    }
}
