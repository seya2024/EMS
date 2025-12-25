<?php

namespace App\Filament\Resources\HQS;

use App\Filament\Resources\HQS\Pages\CreateHQ;
use App\Filament\Resources\HQS\Pages\EditHQ;
use App\Filament\Resources\HQS\Pages\ListHQS;
use App\Filament\Resources\HQS\Schemas\HQForm;
use App\Filament\Resources\HQS\Tables\HQSTable;
use App\Models\HQ;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HQResource extends Resource
{
    protected static ?string $model = HQ::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $navigationLabel = 'Head Office';
    protected static ?string $recordTitleAttribute = 'HeadQuarter';

    protected static string | UnitEnum | null $navigationGroup = 'Working Units';


    // protected static ?string $navigationParentItem = 'Working Units'; // parent item in sidebar

    protected static ?int $navigationSort = 100; // position in sidebar

    public static function form(Schema $schema): Schema
    {
        return HQForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HQSTable::configure($table);
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
            'index' => ListHQS::route('/'),
            // 'create' => CreateHQ::route('/create'),
            // 'edit' => EditHQ::route('/{record}/edit'),
        ];
    }
}
