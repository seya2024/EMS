<?php

namespace App\Filament\Resources\HQS\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class HQForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')->label('Head office')->required(),
                TextInput::make('slogan')->label('Slogan')->required(),
                //
            ]);
    }
}
