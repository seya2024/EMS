<?php

namespace App\Filament\Resources\AssetClasses;

use App\Filament\Resources\AssetClasses\Pages\CreateAssetClass;
use App\Filament\Resources\AssetClasses\Pages\EditAssetClass;
use App\Filament\Resources\AssetClasses\Pages\ListAssetClasses;
use App\Filament\Resources\AssetClasses\Schemas\AssetClassForm;
use App\Filament\Resources\AssetClasses\Tables\AssetClassesTable;
use App\Models\AssetClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AssetClassResource extends Resource
{
    protected static ?string $model = AssetClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Asset Class';


    protected static string | UnitEnum | null $navigationGroup = 'Settings';




    public static function form(Schema $schema): Schema
    {
        return AssetClassForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssetClassesTable::configure($table);
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
            'index' => ListAssetClasses::route('/'),
            // 'create' => CreateAssetClass::route('/create'),
            // 'edit' => EditAssetClass::route('/{record}/edit'),
        ];
    }
}
