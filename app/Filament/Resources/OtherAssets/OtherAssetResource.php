<?php

namespace App\Filament\Resources\OtherAssets;

use App\Filament\Resources\OtherAssets\Pages\CreateOtherAsset;
use App\Filament\Resources\OtherAssets\Pages\EditOtherAsset;
use App\Filament\Resources\OtherAssets\Pages\ListOtherAssets;
use App\Filament\Resources\OtherAssets\Schemas\OtherAssetForm;
use App\Filament\Resources\OtherAssets\Tables\OtherAssetsTable;
use App\Models\OtherAsset;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OtherAssetResource extends Resource
{
    protected static ?string $model = OtherAsset::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Fixed assets';

    protected static ?string $navigationLabel = 'Non-dgital assets';

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';



    public static function form(Schema $schema): Schema
    {
        return OtherAssetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OtherAssetsTable::configure($table);
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
            'index' => ListOtherAssets::route('/'),
            // 'create' => CreateOtherAsset::route('/create'),
            // 'edit' => EditOtherAsset::route('/{record}/edit'),
        ];
    }
}
