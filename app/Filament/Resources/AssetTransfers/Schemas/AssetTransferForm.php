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
use App\Models\AssetTransfer;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Facades\DB;

class AssetTransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Asset Type
                Select::make('assetable_type')
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
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn($set) => $set('assetable_id', null))
                    ->required(),

                // Asset Selection
                Select::make('assetable_id')
                    ->label('Asset')
                    ->options(fn(callable $get) => match ($get('assetable_type')) {
                        Computer::class => Computer::with('model')->get()->mapWithKeys(fn($c) => [$c->id => $c->display_name]),
                        ATM::class      => ATM::all()->mapWithKeys(fn($a) => [$a->id => $a->display_name]),
                        Printer::class  => Printer::all()->mapWithKeys(fn($p) => [$p->id => $p->display_name]),
                        Scanner::class  => Scanner::all()->mapWithKeys(fn($s) => [$s->id => $s->display_name]),
                        Dongle::class   => Dongle::all()->mapWithKeys(fn($d) => [$d->id => $d->display_name]),
                        DOB::class      => DOB::all()->mapWithKeys(fn($d) => [$d->id => $d->display_name]),
                        Photocopy::class => Photocopy::all()->mapWithKeys(fn($p) => [$p->id => $p->display_name]),
                        Pos::class      => Pos::all()->mapWithKeys(fn($p) => [$p->id => $p->display_name]),
                        OtherAsset::class => OtherAsset::all()->mapWithKeys(fn($o) => [$o->id => $o->display_name]),
                        default => [],
                    })
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->required()->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($get('assetable_type') && $state) {
                            $asset = $get('assetable_type')::find($state);
                            $set('from_branch_id', $asset->branch_id); // ✅ FK will be valid
                        }
                    })
                    ->required(),

                // Hidden From Branch
                Hidden::make('from_branch_id')
                    ->reactive()
                    ->dehydrated()
                    ->required(),

                Select::make('to_branch_id')
                    ->label('To Branch')
                    ->options(
                        fn(callable $get) => ($asset = ($get('assetable_type') && $get('assetable_id')
                            ? $get('assetable_type')::find($get('assetable_id'))
                            : null))
                            ? Branch::where('id', '!=', $asset->branch_id)->pluck('name', 'id')
                            : Branch::pluck('name', 'id')
                    )
                    ->required(),

                // Action Type
                Select::make('action')
                    ->label('Action')
                    ->options([
                        'Handover' => 'Handover',
                        'Takeover' => 'Takeover',
                        'Transfer' => 'Transfer',
                        'Disposal' => 'Disposal',
                    ])
                    ->required(),

                // Performed by
                Hidden::make('performed_by')
                    ->default(fn() => Filament::auth()->user()?->id),

                // Performed at
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
