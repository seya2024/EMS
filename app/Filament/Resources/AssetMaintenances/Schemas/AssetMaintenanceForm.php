<?php

namespace App\Filament\Resources\AssetMaintenances\Schemas;

use App\Models\OU;
use App\Models\ATM;
use App\Models\DOB;
use App\Models\Pos;
use Filament\Forms;
use App\Models\Dongle;
use App\Models\Printer;
use App\Models\Scanner;
use App\Models\Computer;
use App\Models\Photocopy;
use App\Models\OtherAsset;
use App\Helpers\AssetTypes;
use App\Models\Photocopier;
use App\Models\SupportUnit;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

class AssetMaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                // // Select Asset Type
                // Select::make('assetable_type')
                //     ->label('Asset Type')
                //     ->options(AssetTypes::all())  
                //     ->reactive()
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

                // Select Asset ID dynamically based on type
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
                    })
                    ->reactive()
                    ->required(),
                //->afterStateUpdated(fn($set) => $set('assetable_id', null)),


                Select::make('ou_id')
                    ->label('Send To')
                    ->options(function () {
                        $branchId = Filament::auth()->user()?->branch_id;

                        if (!$branchId) {
                            return [];
                        }

                        return OU::query()
                            ->where('id', '!=', $branchId)
                            ->pluck('name', 'id');
                    })
                    ->required(),

                // Automatically set branch_id from logged-in user
                Hidden::make('branch_id')
                    ->default(fn() => Filament::auth()->user()?->branch_id),
                // Problem description

                Hidden::make('user_id')
                    ->default(fn() => Filament::auth()->user()?->id),
                // Problem description

                Textarea::make('problem')
                    ->label('Problem')
                    ->rows(3)
                    ->required(),

                // Sent date
                DatePicker::make('sent_date')
                    ->required(),

                // Return date (optional)
                DatePicker::make('return_date'),

                // Status
                Select::make('status')
                    ->options([
                        'SENT' => 'Sent',
                        'IN_PROGRESS' => 'In Progress',
                        'RECEIVED' => 'Received',
                        'CLOSED' => 'Closed',
                    ])
                    ->default('SENT')
                    ->required(),
            ]);
    }
}
