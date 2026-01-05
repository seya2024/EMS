<?php

namespace App\Filament\Resources\Quarters;

use App\Filament\Resources\Quarters\Pages\CreateQuarter;
use App\Filament\Resources\Quarters\Pages\EditQuarter;
use App\Filament\Resources\Quarters\Pages\ListQuarters;
use App\Filament\Resources\Quarters\Schemas\QuarterForm;
use App\Filament\Resources\Quarters\Tables\QuartersTable;
use App\Models\Quarter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class QuarterResource extends Resource
{
    protected static ?string $model = Quarter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Quarter';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';


    public static function form(Schema $schema): Schema
    {
        return QuarterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuartersTable::configure($table);
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
            'index' => ListQuarters::route('/'),
            // 'create' => CreateQuarter::route('/create'),
            // 'edit' => EditQuarter::route('/{record}/edit'),
        ];
    }
}
