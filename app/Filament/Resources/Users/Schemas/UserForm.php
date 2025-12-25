<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Grid;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                #TextInput::make('name')->required()->columnSpan(3),

                TextInput::make('fname')->label('First Name')->required(),
                TextInput::make('mname')->label('Father Name')->required(),
                TextInput::make('lname')->label('Last Name')->required(),

                //TextInput::make('name')->required(),
                TextInput::make('email')->label('Email address')->email()->required(),
                //DateTimePicker::make('email_verified_at'),
                TextInput::make('password')->password()->required(),

                TextInput::make('email')->label('Email address')->email()->required(),
                TextInput::make('phone')->tel()->required(),
                TextInput::make('address')->maxLength(255),
                TextInput::make('working_unit')->label('Working Unit / Department')->required(),




                Select::make('role')->options([
                    'admin'   => 'System administrator',
                    'head' => 'Head',
                    'stock-keeper'    => 'Stoke Keeper',
                ])->required(),
            ]);
    }
}
