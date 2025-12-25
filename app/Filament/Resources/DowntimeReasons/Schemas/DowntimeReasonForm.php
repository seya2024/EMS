<?php

namespace App\Filament\Resources\DowntimeReasons\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;


class DowntimeReasonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Reason Name')
                    ->required()
                    ->maxLength(255),

                Select::make('responsible')
                    ->label('Responsible Party')
                    ->required()
                    ->options([
                        'Digital-channel' => 'Digital Channel',
                        'IT-Operatiom' => 'IT Operatiom',
                        'The-branch' => 'The branch',
                        'Vendor' => ' ATM Vendor',
                        'Ethiotelecom' => 'Ethiotelecom',
                        'Electric-Utility' => 'Electric Utility',
                        'Collective' => 'Collective Responsiblity',

                    ]),
            ]);
    }
}
