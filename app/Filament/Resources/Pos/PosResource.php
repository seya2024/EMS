<?php

namespace App\Filament\Resources\Pos;

use App\Filament\Resources\Pos\Pages\CreatePos;
use App\Filament\Resources\Pos\Pages\EditPos;
use App\Filament\Resources\Pos\Pages\ListPos;
use App\Filament\Resources\Pos\Schemas\PosForm;
use App\Filament\Resources\Pos\Tables\PosTable;
use App\Models\Pos;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class PosResource extends Resource
{
    protected static ?string $model = Pos::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Pos Machine';

    protected static ?string $navigationLabel = 'List of Pos Machines';

    // protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';
    protected static string | UnitEnum | null $navigationGroup = 'Channel Bankings';

    public static function form(Schema $schema): Schema
    {
        return PosForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {

        return Pos::count();
    }

    public static function table(Table $table): Table
    {
        return PosTable::configure($table);
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
            'index' => ListPos::route('/'),
            // 'create' => CreatePos::route('/create'),
            // 'edit' => EditPos::route('/{record}/edit'),
        ];
    }
}
