<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Table;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                #TextInput::make('name')->required()->columnSpan(3),

                TextInput::make('name')->label('Domain')->required(),

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

                Select::make('branch_id')
                    ->label('Working Unit / Department')
                    ->required() //->searchable(true)
                    ->relationship('branch', 'name')->searchable()
                    ->preload(),

                // Select::make('role')
                //     ->options([
                //         'admin' => 'Super Admin',
                //         'uadmin' => 'System administrator',
                //         'branch' => 'Branch',
                //         'head' => 'Head',
                //         'stocker' => 'Stocker',
                //     ])
                //     ->nullable() // allows leaving empty
                //     ->placeholder('Select a role'),

                Hidden::make('role')->default('admin'),

                TextInput::make('employee_id')->label('Employee ID')->nullable()->placeholder('DB/17357/24'),
                Toggle::make('isActive')
                    ->label('Active Account')
                    ->default(false)->onIcon(Heroicon::Star),



                // Select::make('user_group_id')
                //     ->label('User group')
                //     ->required() //->searchable(true)
                //     ->relationship('userGroups', 'description'),



            ]);
    }
}
