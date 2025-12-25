<?php

namespace App\Filament\Resources\FixedLines;

use App\Filament\Resources\FixedLines\Pages\CreateFixedLine;
use App\Filament\Resources\FixedLines\Pages\EditFixedLine;
use App\Filament\Resources\FixedLines\Pages\ListFixedLines;
use App\Filament\Resources\FixedLines\Schemas\FixedLineForm;
use App\Filament\Resources\FixedLines\Tables\FixedLinesTable;
use App\Models\FixedLine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FixedLineResource extends Resource
{
    protected static ?string $model = FixedLine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'FixedLine';
    protected static string | UnitEnum | null $navigationGroup = 'Subscriptions';

    public static function form(Schema $schema): Schema
    {
        return FixedLineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FixedLinesTable::configure($table);
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
            'index' => ListFixedLines::route('/'),
            // 'create' => CreateFixedLine::route('/create'),
            // 'edit' => EditFixedLine::route('/{record}/edit'),
        ];
    }
}
