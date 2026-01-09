<?php

namespace App\Filament\Resources\Pos;

use UnitEnum;
use BackedEnum;
use App\Models\Pos;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Pos\Pages\EditPos;
use App\Filament\Resources\Pos\Pages\ListPos;
use App\Filament\Resources\Pos\Pages\CreatePos;
use App\Filament\Resources\Pos\Schemas\PosForm;
use App\Filament\Resources\Pos\Tables\PosTable;


class PosResource extends Resource
{
    protected static ?string $model = Pos::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Pos Machine';

    protected static ?string $navigationLabel = 'List of Pos Machines';

    // protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';
    protected static string | UnitEnum | null $navigationGroup = 'Channel Bankings';

    public static function form(Schema $schema): Schema
    {
        return PosForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {

        return Pos::count();
    }

    public static function table(Table $table): Table
    {
        return PosTable::configure($table)->emptyStateActions([
            Action::make('create')
                ->label('Create new record here')
                ->url('/create')  // Direct URL works in Filament 4
                ->icon('heroicon-m-plus')
                ->button(),
        ]);
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
            'index' => ListPos::route('/'),
            // 'create' => CreatePos::route('/create'),
            // 'edit' => EditPos::route('/{record}/edit'),
        ];
    }
}
