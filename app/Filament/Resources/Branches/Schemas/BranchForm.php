<?php

namespace App\Filament\Resources\Branches\Schemas;


use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Grid;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([



                TextInput::make('code')->label('Code')->required(),
                TextInput::make('name')->label('Name')->required(),
                TextInput::make('grade')->label('Grade')->required(),

                Select::make('district_id')
                    ->label('District Office')
                    ->relationship('district', 'name') // 'district' = relation method in your model, 'name' = column to display
                    ->required()


            ]);
    }
}
