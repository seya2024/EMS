<?php

namespace App\Filament\Resources\ComputerModels;

use App\Filament\Resources\ComputerModels\Pages\CreateComputerModel;
use App\Filament\Resources\ComputerModels\Pages\EditComputerModel;
use App\Filament\Resources\ComputerModels\Pages\ListComputerModels;
use App\Filament\Resources\ComputerModels\Schemas\ComputerModelForm;
use App\Filament\Resources\ComputerModels\Tables\ComputerModelsTable;
use App\Models\ComputerModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ComputerModelResource extends Resource
{
    protected static ?string $model = ComputerModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'Computer Model';
    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return ComputerModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComputerModelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getNavigationBadge(): ?string
    {

        return ComputerModel::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComputerModels::route('/'),
            // 'create' => CreateComputerModel::route('/create'),
            // 'edit' => EditComputerModel::route('/{record}/edit'),
        ];
    }
}
