<?php

namespace App\Filament\Resources\AssetClasses\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class AssetClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
