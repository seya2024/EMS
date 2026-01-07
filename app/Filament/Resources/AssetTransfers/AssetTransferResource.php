<?php

namespace App\Filament\Resources\AssetTransfers;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\AssetTransfer;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\AssetTransfers\Pages\EditAssetTransfer;
use App\Filament\Resources\AssetTransfers\Pages\ListAssetTransfers;
use App\Filament\Resources\AssetTransfers\Pages\CreateAssetTransfer;
use App\Filament\Resources\AssetTransfers\Schemas\AssetTransferForm;
use App\Filament\Resources\AssetTransfers\Tables\AssetTransfersTable;

class AssetTransferResource extends Resource
{
    protected static ?string $model = AssetTransfer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Asset Transfer';

    protected static string | UnitEnum | null $navigationGroup = 'Asset Audit';

    public static function form(Schema $schema): Schema
    {
        return AssetTransferForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssetTransfersTable::configure($table);
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
            'index' => ListAssetTransfers::route('/'),
            // 'create' => CreateAssetTransfer::route('/create'),
            // 'edit' => EditAssetTransfer::route('/{record}/edit'),
        ];
    }
}
