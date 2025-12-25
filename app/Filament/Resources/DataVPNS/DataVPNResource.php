<?php

namespace App\Filament\Resources\DataVPNS;

use App\Filament\Resources\DataVPNS\Pages\CreateDataVPN;
use App\Filament\Resources\DataVPNS\Pages\EditDataVPN;
use App\Filament\Resources\DataVPNS\Pages\ListDataVPNS;
use App\Filament\Resources\DataVPNS\Schemas\DataVPNForm;
use App\Filament\Resources\DataVPNS\Tables\DataVPNSTable;
use App\Models\DataVPN;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DataVPNResource extends Resource
{
    protected static ?string $model = DataVPN::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataVPN';


    protected static string | UnitEnum | null $navigationGroup = 'Subscriptions';

    public static function form(Schema $schema): Schema
    {
        return DataVPNForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataVPNSTable::configure($table);
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
            'index' => ListDataVPNS::route('/'),
            // 'create' => CreateDataVPN::route('/create'),
            // 'edit' => EditDataVPN::route('/{record}/edit'),
        ];
    }
}
