<?php

namespace App\Filament\Resources\DataVPNS\Schemas;

use Filament\Forms;
use App\Models\Branch;
use Filament\Resources\Form;
use Filament\Schemas\Schema;


use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class DataVPNForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('serviceNo')
                    ->label('Service Number')
                    ->required()
                    ->maxLength(255),

                TextInput::make('lANIp')
                    ->label('LAN IP')
                    ->required()
                    ->maxLength(255),

                TextInput::make('wanIp')
                    ->label('WAN IP')
                    ->maxLength(255),

                TextInput::make('bandwidth')
                    ->label('Network Bandwidth')
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
                    ->options(Branch::all()->pluck('name', 'id')) // assumes Branch has 'id' and 'name'
                    ->searchable() // allows filtering/search in dropdown
                    ->required(),

                Select::make('media')
                    ->label('Media type')
                    ->options([
                        'Copper' => 'Copper',
                        'Fiber'  => 'Fiber',
                    ])
                    ->required(),

                Select::make('linkType')
                    ->label('Link Type')
                    ->options([
                        'EPON'      => 'EPON',
                        'GPON'      => 'GPON',
                        'ADSL'      => 'ADSL',
                        'Toilored'  => 'Toilored',
                        'VSAT'      => 'VSAT',
                        '4G'        => '4G',
                    ])
                    ->required(),

                TextInput::make('vlan')
                    ->label('VLAN')
                    ->maxLength(255),

                Textarea::make('remark')
                    ->label('Remark')
                    ->rows(3),

            ]);
    }
}
