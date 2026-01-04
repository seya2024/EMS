<?php

namespace App\Filament\Resources\UserGroups\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;

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

                // Select::make('users')
                //     ->label('Assign Users')
                //     ->multiple()
                //     ->relationship('users', 'name') // assumes User model has 'name'
                //     ->searchable()
                //     ->preload(),


                Select::make('users')
                    ->label('Assign Users')
                    ->multiple()->relationship('users', 'id')  // store ID in pivot
                    ->options(
                        User::all()->pluck('full_name', 'id')->toArray()
                    )
                    ->searchable()
                    ->preload(),

                // Assign permissions
                // Select::make('permissions')
                //     ->label('Assign Permissions')
                //     ->multiple()
                //     ->relationship('permissions', 'name') // shows permission name
                //     ->preload()
                //     ->searchable(),


                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->columns(2), // adjust columns as needed


            ]);
    }
}
