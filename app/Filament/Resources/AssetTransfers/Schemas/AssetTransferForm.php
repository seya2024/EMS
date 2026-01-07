<?php

namespace App\Filament\Resources\AssetTransfers\Schemas;

use App\Models\ATM;
use App\Models\DOB;
use App\Models\Pos;
use App\Models\User;
use App\Models\Branch;
use App\Models\Dongle;
use App\Models\Printer;
use App\Models\Scanner;
use App\Models\Computer;
use App\Models\Photocopy;
use App\Models\OtherAsset;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Get;

class AssetTransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Asset Type
                // Select::make('asset_type')
                //     ->label('Asset Type')
                //     ->options([
                //         'Computer' => 'Computer',
                //         'atm' => 'ATM',
                //         'Printer' => 'Printer',
                //         'scanner' => 'Scanner',
                //         'dongle' => 'Dongle',
                //         'dob' => 'DOB',
                //         'photocopy' => 'Photocopy',
                //         'pos' => 'POS',
                //         'non_digital_asset' => 'Other Asset',
                //     ])
                //     ->required(),

                // // Asset ID
                // TextInput::make('asset_id')
                //     ->label('Asset ID')
                //     ->numeric()
                //     ->required(),


                Select::make('assetable_type')  //App\Models\ModelName
                    ->label('Asset Type')
                    ->options([
                        Computer::class   => 'Computer',
                        ATM::class        => 'ATM',
                        Printer::class    => 'Printer',
                        Scanner::class    => 'Scanner',
                        Dongle::class     => 'Dongle',
                        DOB::class        => 'DOB',
                        Photocopy::class  => 'Photocopy',
                        Pos::class        => 'POS',
                        OtherAsset::class => 'Other Asset',
                    ])->reactive()->afterStateUpdated(fn($set) => $set('assetable_id', null))->required(),
                Select::make('assetable_id')
                    ->label('Asset')
                    ->options(fn(callable $get) => match ($get('assetable_type')) {
                        Computer::class => Computer::with('model')->get()->mapWithKeys(fn($c) => [
                            $c->id => $c->display_name, // accessor works here
                        ]),
                        ATM::class      => ATM::all()->mapWithKeys(fn($a) => [
                            $a->id => $a->display_name,
                        ]),
                        Printer::class  => Printer::all()->mapWithKeys(fn($p) => [
                            $p->id => $p->display_name,
                        ]),
                        Scanner::class  => Scanner::all()->mapWithKeys(fn($s) => [
                            $s->id => $s->display_name,
                        ]),
                        Dongle::class   => Dongle::all()->mapWithKeys(fn($d) => [
                            $d->id => $d->display_name,
                        ]),
                        DOB::class      => DOB::all()->mapWithKeys(fn($d) => [
                            $d->id => $d->display_name,
                        ]),
                        Photocopy::class => Photocopy::all()->mapWithKeys(fn($p) => [
                            $p->id => $p->display_name,
                        ]),
                        Pos::class      => Pos::all()->mapWithKeys(fn($p) => [
                            $p->id => $p->display_name,
                        ]),
                        OtherAsset::class => OtherAsset::all()->mapWithKeys(fn($o) => [
                            $o->id => $o->display_name,
                        ]),
                        default => [],
                    })->searchable()
                    ->reactive()
                    ->required()->preload(),


                // From Branch
                Select::make('from_branch_id')
                    ->label('From Branch')
                    ->options(Branch::pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('to_branch_id', null)),

                // To Branch
                Select::make('to_branch_id')
                    ->label('To Branch')
                    ->options(
                        fn(callable $get) =>
                        Branch::where('id', '!=', $get('from_branch_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),


                // Action Type
                Select::make('action')
                    ->label('Action')
                    ->options([
                        'handover' => 'Handover',
                        'takeover' => 'Takeover',
                        'transfer' => 'Transfer',
                        'disposal' => 'Disposal',
                    ])
                    ->required(),


                Hidden::make('performed_by')
                    ->default(fn() => Filament::auth()->user()?->id),
                // Problem description


                Hidden::make('performed_at')
                    ->default(fn() => now())
                    ->required(),
                // Remarks
                Textarea::make('remarks')
                    ->label('Remarks')
                    ->rows(3),
            ]);
    }
}
