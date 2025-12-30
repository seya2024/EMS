<?php

namespace App\Filament\Resources\ATMReports;

use App\Filament\Resources\ATMReports\Pages\CreateATMReport;
use App\Filament\Resources\ATMReports\Pages\EditATMReport;
use App\Filament\Resources\ATMReports\Pages\ListATMReports;
use App\Filament\Resources\ATMReports\Schemas\ATMReportForm;
use App\Filament\Resources\ATMReports\Tables\ATMReportsTable;
use App\Models\ATMReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ATMReportResource extends Resource
{
    protected static ?string $model = ATMReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'ATMReport';


    protected static ?string $navigationLabel = 'Daily ATM Reports';

    //protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static string | UnitEnum | null $navigationGroup = 'Reportings';



    public static function form(Schema $schema): Schema
    {
        return ATMReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ATMReportsTable::configure($table);
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
            'index' => ListATMReports::route('/'),
            // 'create' => CreateATMReport::route('/create'),
            // 'edit' => EditATMReport::route('/{record}/edit'),
        ];
    }
}
