<?php

namespace App\Filament\Resources\FixedLines\Schemas;

use App\Models\Branch;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class FixedLineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('serviceNo')
                    ->label('Service Number')
                    ->required()
                    ->maxLength(255),


                Select::make('account')
                    ->label('Account')
                    ->options([
                        '760094' => '760094 is for fixed line',
                        '1214121' => '1214121 is for Data VPN',

                    ])
                    ->searchable()
                    ->required(),

                Select::make('branch_id')
                    ->label('Branch')
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),


                Select::make('media')
                    ->label('Media')
                    ->options([
                        'Copper' => 'Copper',
                        'Fiber'  => 'Fiber',
                    ])
                    ->nullable(),

                Textarea::make('remark')
                    ->label('Remark')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
