<?php

namespace App\Filament\Resources\UserGroups\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Group Name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('description')
                    ->label('Description')
                    ->maxLength(255),

                Select::make('users')
                    ->label('Assign Users')
                    ->multiple()
                    ->relationship('users', 'name') // assumes User model has 'name'
                    ->searchable()
                    ->preload(),
            ]);
    }
}
