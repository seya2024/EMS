<?php

namespace App\Filament\Resources\Outlets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Table;

use Filament\Schemas\Schema;

class OutletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //



                TextInput::make('name')->label('Name')->required(),
                // TextInput::make('grade')->label('Grade')->required(),

                Select::make('branch_id')
                    ->label('Branch')
                    ->relationship('branch', 'name'),

            ]);
    }
}
