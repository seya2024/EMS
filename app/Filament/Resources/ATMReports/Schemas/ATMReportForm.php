<?php

namespace App\Filament\Resources\ATMReports\Schemas;

use App\Models\ATM;
use Filament\Forms;
use App\Models\User;
use App\Models\Branch;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class ATMReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Custodian / Branch
                Select::make('custodian')
                    ->label('Custodian / Branch')
                    ->options(Branch::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),


                Select::make('atm_id')
                    ->label('Terminal ID')
                    ->options(ATM::all()->pluck('terminal', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('downtime_reason_id')
                    ->label('Downtime Reason')
                    ->relationship('downtimeReason', 'name') // model relationship + display column
                    ->required(),


                Select::make('closed_by')
                    ->label('Closed By')
                    ->options(fn() => User::all()->pluck('name', 'id')) // load all users
                    ->default(fn() => Auth::id())                     // current user
                    ->disabled()                                      // read-only
                    ->visible(fn($record) => $record !== null),     // only on edit


                Select::make('action_taken')
                    ->label('Action Taken')
                    ->options([
                        'Under follow-up with the branch' => 'Under follow-up with the branch',
                        'Communicated with the Branch' => 'Communicated with the Branch',
                        'Under follow-up with the vendor' => 'Under follow-up with vendor',
                        'Under follow-up with Ethiotelecom' => 'Under follow-up with Ethiotelecom'

                    ])
                    ->required(),

                // Down time in days
                TextInput::make('down_time_in_days')
                    ->label('Down Time (Days)')
                    ->numeric()
                    ->step(0.01)  // allows decimal input
                    ->required(),

                // Open and Close Dates
                DatePicker::make('open_date')
                    ->label('Open Date')->required(),

                DatePicker::make('close_date')
                    ->label('Close Date')
                    ->nullable(),

                // Call ID
                TextInput::make('call_ID')
                    ->label('Call ID')
                    ->maxLength(255)
                    ->nullable()->placeholder('11256'),

                // TT
                TextInput::make('TT')
                    ->label('TT')
                    ->maxLength(255)
                    ->nullable()->placeholder('CCT2026-MM-DD-524915570'),

                // Optional: Display creator (read-only)

                Select::make('created_by')
                    ->label('Sender')
                    ->options(function () {
                        $user = Filament::auth()->user();
                        return $user ? [$user->id => $user->full_name] : [];
                    })
                    ->default(Filament::auth()->id())
                    ->disabled(),

            ]);
    }
}
