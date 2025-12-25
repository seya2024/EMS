<?php

namespace App\Filament\Resources\Dongles;

use App\Filament\Resources\Dongles\Pages\CreateDongle;
use App\Filament\Resources\Dongles\Pages\EditDongle;
use App\Filament\Resources\Dongles\Pages\ListDongles;
use App\Filament\Resources\Dongles\Schemas\DongleForm;
use App\Filament\Resources\Dongles\Tables\DonglesTable;
use App\Models\Dongle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DongleResource extends Resource
{
    protected static ?string $model = Dongle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Network backup';

    protected static ?string $navigationLabel = 'List of Dongles';

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';

    public static function form(Schema $schema): Schema
    {
        return DongleForm::configure($schema);
    }


    public static function getNavigationBadge(): ?string
    {

        return Dongle::count();
    }

    public static function table(Table $table): Table
    {
        return DonglesTable::configure($table);
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
            'index' => ListDongles::route('/'),
            // 'create' => CreateDongle::route('/create'),
            // 'edit' => EditDongle::route('/{record}/edit'),
        ];
    }
}
