<?php

namespace App\Filament\Resources\ATMS\Schemas;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use App\Models\Branch;

use Filament\Schemas\Schema;

class ATMForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('terminal')
                    ->label('Terminal ID')
                    ->required()
                    ->maxLength(255),
                Select::make('os')
                    ->label('Operating System')
                    ->options([
                        '7' => 'Windows 7',
                        '10' => 'Windows 10',
                        '11' => 'Windows 11',

                    ])
                    ->required(),

                Select::make('type')
                    ->label('ATM Type')
                    ->options([
                        'GRG' => 'GRG',
                        'NCR' => 'NCR',
                    ])
                    ->required(),

                Select::make('location')
                    ->label('ATM site')
                    ->options([
                        'Off-branch' => 'Off-branch',
                        'On-branch' => 'On-branch',
                    ])
                    ->required(),

                Select::make('design')
                    ->label('ATM Design')
                    ->options([
                        'TTW' => 'TTW',
                        'Lobby' => 'Lobby',
                    ])
                    ->required(),


                Select::make('custodian')
                    ->label('Custodian / Branch')
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),



                Textarea::make('remark')
                    ->label('Remark')
                    ->rows(3),
            ]);
    }
}
