<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('District Name')
                    ->required()
                    ->maxLength(10),

                TextInput::make('director')
                    ->label('Director Name')
                    ->required()
                    ->maxLength(255),


            ]);
    }
}
