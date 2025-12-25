<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Display full name as concatenation
                TextEntry::make('fname')->label('First Name'),
                TextEntry::make('mname')->label('Father Name'),
                TextEntry::make('lname')->label('Last Name'),

                TextEntry::make('email')->label('Email address'),
                TextEntry::make('phone')->label('Phone'),
                TextEntry::make('address')->label('Address')->placeholder('-'),
                TextEntry::make('working_unit')->label('Working Unit'),

                TextEntry::make('role')->label('Role'),

                TextEntry::make('email_verified_at')
                    ->label('Email Verified At')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
