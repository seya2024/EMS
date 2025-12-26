<?php

namespace App\Filament\Resources\OUS\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class OUForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('description')
                    ->label('Description')->maxLength(255),
            ]);
    }
}
