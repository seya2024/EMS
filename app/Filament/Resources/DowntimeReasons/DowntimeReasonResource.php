<?php

namespace App\Filament\Resources\DowntimeReasons;

use App\Filament\Resources\DowntimeReasons\Pages\CreateDowntimeReason;
use App\Filament\Resources\DowntimeReasons\Pages\EditDowntimeReason;
use App\Filament\Resources\DowntimeReasons\Pages\ListDowntimeReasons;
use App\Filament\Resources\DowntimeReasons\Schemas\DowntimeReasonForm;
use App\Filament\Resources\DowntimeReasons\Tables\DowntimeReasonsTable;
use App\Models\DowntimeReason;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class DowntimeReasonResource extends Resource
{
    protected static ?string $model = DowntimeReason::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DowntimeReason';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return DowntimeReasonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DowntimeReasonsTable::configure($table);  // for table header action
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {

        return DowntimeReason::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDowntimeReasons::route('/'),
            // 'create' => CreateDowntimeReason::route('/create'),
            // 'edit' => EditDowntimeReason::route('/{record}/edit'),
        ];
    }
}
