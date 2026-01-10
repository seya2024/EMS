<?php

namespace App\Filament\Resources\ATMS;

use UnitEnum;
use BackedEnum;
use App\Models\ATM;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\ATMS\Pages\EditATM;
use App\Filament\Resources\ATMS\Pages\ListATMS;
use App\Filament\Resources\ATMS\Pages\CreateATM;
use App\Filament\Resources\ATMS\Schemas\ATMForm;
use App\Filament\Resources\ATMS\Tables\ATMSTable;

class ATMResource extends Resource
{
    protected static ?string $model = ATM::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ATM';
    protected static string | UnitEnum | null $navigationGroup = 'Channel Bankings';

    public static function form(Schema $schema): Schema
    {
        return ATMForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ATMSTable::configure($table)->emptyStateDescription('Once you add your first ATM, it will appear here.')

            ->groups([
                Group::make('branch.district.name')->label('District Office')
                    ->getDescriptionFromRecordUsing(fn(ATM $record): string => $record->status?->getDescription() ?? ' List of ATMs under above district office with respective ranches')->collapsible(),
                Group::make('branch.name')->label('Castodian Branch')->collapsible(),
                Group::make('type')->label('ATM Type')->collapsible(),
                Group::make('design')->label('ATM Design')->collapsible(),

            ]); //->collapsedGroupsByDefault();

        // You can uncomment below if you want a simpler grouping example:
        // return $table->groups(['author.name']);
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
            'index' => ListATMS::route('/'),
            // 'create' => CreateATM::route('/create'),
            // 'edit' => EditATM::route('/{record}/edit'),
        ];
    }
}
