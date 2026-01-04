<?php

namespace App\Filament\Resources\HardwareTypes;

use App\Filament\Resources\HardwareTypes\Pages\CreateHardwareType;
use App\Filament\Resources\HardwareTypes\Pages\EditHardwareType;
use App\Filament\Resources\HardwareTypes\Pages\ListHardwareTypes;
use App\Filament\Resources\HardwareTypes\Schemas\HardwareTypeForm;
use App\Filament\Resources\HardwareTypes\Tables\HardwareTypesTable;
use App\Models\HardwareType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HardwareTypeResource extends Resource
{
    protected static ?string $model = HardwareType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Hardware type';
    protected static string | UnitEnum | null $navigationGroup = 'Settings';


    public static function form(Schema $schema): Schema
    {
        return HardwareTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HardwareTypesTable::configure($table);
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
            'index' => ListHardwareTypes::route('/'),
            // 'create' => CreateHardwareType::route('/create'),
            // 'edit' => EditHardwareType::route('/{record}/edit'),
        ];
    }
}
