<?php

namespace App\Filament\Resources\AssetMaintenances;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\AssetMaintenance;
use Filament\Actions\BulkAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Collection;
use App\Filament\Resources\AssetMaintenances\Pages\EditAssetMaintenance;
use App\Filament\Resources\AssetMaintenances\Pages\ListAssetMaintenances;
use App\Filament\Resources\AssetMaintenances\Pages\CreateAssetMaintenance;
use App\Filament\Resources\AssetMaintenances\Schemas\AssetMaintenanceForm;
use App\Filament\Resources\AssetMaintenances\Tables\AssetMaintenancesTable;

class AssetMaintenanceResource extends Resource
{
    protected static ?string $model = AssetMaintenance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Maintenance Request(S)';

    protected static ?string $navigationLabel = 'Pending Requests';
    protected static string | UnitEnum | null $navigationGroup = 'Support';


    public static function form(Schema $schema): Schema
    {
        return AssetMaintenanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssetMaintenancesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function getTitle(): string
    {
        return ' New Maintenance Request()';
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) AssetMaintenance::where('status', 'SENT')->count();
    }



    public static function getPages(): array
    {
        return [
            'index' => ListAssetMaintenances::route('/'),
            // 'create' => CreateAssetMaintenance::route('/create'),
            // 'edit' => EditAssetMaintenance::route('/{record}/edit'),
        ];
    }
}
