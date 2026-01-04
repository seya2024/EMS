<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Table;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([





                // Select::make('user_group_id')
                //     ->label('User group')
                //     ->required() //->searchable(true)
                //     ->relationship('userGroups', 'description'),



            ]);
    }
}
