<?php

namespace App\Filament\Resources\Dobs;

use App\Filament\Resources\Dobs\Pages\CreateDob;
use App\Filament\Resources\Dobs\Pages\EditDob;
use App\Filament\Resources\Dobs\Pages\ListDobs;
use App\Filament\Resources\Dobs\Schemas\DobForm;
use App\Filament\Resources\Dobs\Tables\DobsTable;
use App\Models\District;
use App\Models\Dob;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DobResource extends Resource
{
    protected static ?string $model = Dob::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Digital Onboarding device';

    protected static ?string $navigationLabel = 'List of DObs';

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';


    public static function form(Schema $schema): Schema
    {
        return DobForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {

        return District::count();
    }

    public static function table(Table $table): Table
    {
        return DobsTable::configure($table);
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
            'index' => ListDobs::route('/'),
            // 'create' => CreateDob::route('/create'),
            // 'edit' => EditDob::route('/{record}/edit'),
        ];
    }
}
