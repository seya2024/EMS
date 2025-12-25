<?php

namespace App\Filament\Resources\Photocopiers;

use App\Filament\Resources\Photocopiers\Pages\CreatePhotocopier;
use App\Filament\Resources\Photocopiers\Pages\EditPhotocopier;
use App\Filament\Resources\Photocopiers\Pages\ListPhotocopiers;
use App\Filament\Resources\Photocopiers\Schemas\PhotocopierForm;
use App\Filament\Resources\Photocopiers\Tables\PhotocopiersTable;
use App\Models\Photocopy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PhotocopierResource extends Resource
{
    protected static ?string $model = Photocopy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Photo Copier';

    protected static ?string $navigationLabel = 'List of Photocopiers';

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';

    public static function form(Schema $schema): Schema
    {
        return PhotocopierForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {

        return Photocopy::count();
    }

    public static function table(Table $table): Table
    {
        return PhotocopiersTable::configure($table);
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
            'index' => ListPhotocopiers::route('/'),
            // 'create' => CreatePhotocopier::route('/create'),
            // 'edit' => EditPhotocopier::route('/{record}/edit'),
        ];
    }
}
