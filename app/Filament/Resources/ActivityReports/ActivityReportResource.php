<?php

namespace App\Filament\Resources\ActivityReports;

use App\Filament\Resources\ActivityReports\Pages\CreateActivityReport;
use App\Filament\Resources\ActivityReports\Pages\EditActivityReport;
use App\Filament\Resources\ActivityReports\Pages\ListActivityReports;
use App\Filament\Resources\ActivityReports\Schemas\ActivityReportForm;
use App\Filament\Resources\ActivityReports\Tables\ActivityReportsTable;
use App\Models\ActivityReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;;

use UnitEnum;

class ActivityReportResource extends Resource
{
    protected static ?string $model = ActivityReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Activity Report';



    protected static ?string $navigationLabel = 'Activity Reports';

    //protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static string | UnitEnum | null $navigationGroup = 'Reportings';

    public static function form(Schema $schema): Schema
    {
        return ActivityReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityReportsTable::configure($table);
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
            'index' => ListActivityReports::route('/'),
            // 'create' => CreateActivityReport::route('/create'),
            // 'edit' => EditActivityReport::route('/{record}/edit'),
        ];
    }
}
