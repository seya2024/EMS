<?php

namespace App\Filament\Resources\ATMS;

use App\Filament\Resources\ATMS\Pages\CreateATM;
use App\Filament\Resources\ATMS\Pages\EditATM;
use App\Filament\Resources\ATMS\Pages\ListATMS;
use App\Filament\Resources\ATMS\Schemas\ATMForm;
use App\Filament\Resources\ATMS\Tables\ATMSTable;
use App\Models\ATM;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ATMResource extends Resource
{
    protected static ?string $model = ATM::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ATM';
    protected static string | UnitEnum | null $navigationGroup = 'Channel Bankings';

    public static function form(Schema $schema): Schema
    {
        return ATMForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ATMSTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListATMS::route('/'),
            // 'create' => CreateATM::route('/create'),
            // 'edit' => EditATM::route('/{record}/edit'),
        ];
    }
}
