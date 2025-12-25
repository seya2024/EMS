<?php

namespace App\Filament\Resources\Scanners;

use App\Filament\Resources\Scanners\Pages\CreateScanner;
use App\Filament\Resources\Scanners\Pages\EditScanner;
use App\Filament\Resources\Scanners\Pages\ListScanners;
use App\Filament\Resources\Scanners\Schemas\ScannerForm;
use App\Filament\Resources\Scanners\Tables\ScannersTable;
use App\Models\Scanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ScannerResource extends Resource
{
    protected static ?string $model = Scanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Scanner';

    protected static ?string $navigationLabel = 'List of Scanners';

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';

    public static function form(Schema $schema): Schema
    {
        return ScannerForm::configure($schema);
    }


    public static function getNavigationBadge(): ?string
    {

        return Scanner::count();
    }

    public static function table(Table $table): Table
    {
        return ScannersTable::configure($table);
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
            'index' => ListScanners::route('/'),
            // 'create' => CreateScanner::route('/create'),
            // 'edit' => EditScanner::route('/{record}/edit'),
        ];
    }
}
