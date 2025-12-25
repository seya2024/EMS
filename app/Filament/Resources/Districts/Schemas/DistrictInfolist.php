<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Schemas\Schema;

class DistrictInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                //       TextEntry::make('branch.name')
                //     ->label('Branch')
                //     ->placeholder('-'),

                // TextEntry::make('name')
                //     ->label('Name')
                //     ->placeholder('-'),

                // TextEntry::make('created_at')
                //     ->label('Created At')
                //     ->dateTime() // ok here for datetime fields
                //     ->placeholder('-'),

                // TextEntry::make('updated_at')
                //     ->label('Updated At')
                //     ->dateTime()
                //     ->placeholder('-'),

            ]);
    }
}
