<?php

namespace App\Filament\Resources\AssetDisposals;

use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\AssetDisposal;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\AssetDisposals\Pages\EditAssetDisposal;
use App\Filament\Resources\AssetDisposals\Pages\ListAssetDisposals;
use App\Filament\Resources\AssetDisposals\Pages\CreateAssetDisposal;
use App\Filament\Resources\AssetDisposals\Schemas\AssetDisposalForm;
use App\Filament\Resources\AssetDisposals\Tables\AssetDisposalsTable;
use UnitEnum;

class AssetDisposalResource extends Resource
{
    protected static ?string $model = AssetDisposal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Asset Disposal';
    protected static string | UnitEnum | null $navigationGroup = 'Asset Audit';

    public static function form(Schema $schema): Schema
    {
        return AssetDisposalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssetDisposalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    /////////////////////////// disabl edit ///////////////////
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }



    ///////////////////////////////////////////////////////////

    public static function getPages(): array
    {
        return [
            'index' => ListAssetDisposals::route('/'),
            'create' => CreateAssetDisposal::route('/create'),
            'edit' => EditAssetDisposal::route('/{record}/edit'),
        ];
    }
}
