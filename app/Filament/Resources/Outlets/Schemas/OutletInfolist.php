<?php

namespace App\Filament\Resources\Outlets\Schemas;

use Filament\Tables\Columns\TextColumn;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OutletInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')
                    ->label('Branch')
                    ->placeholder('-'),

                TextEntry::make('name')
                    ->label('Name')
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime() // ok here for datetime fields
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
