<?php

namespace App\Filament\Resources\OUS;

use App\Filament\Resources\OUS\Pages\CreateOU;
use App\Filament\Resources\OUS\Pages\EditOU;
use App\Filament\Resources\OUS\Pages\ListOUS;
use App\Filament\Resources\OUS\Schemas\OUForm;
use App\Filament\Resources\OUS\Tables\OUSTable;
use App\Models\OU;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OUResource extends Resource
{
    protected static ?string $model = OU::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Organizational Unit';

    public static function form(Schema $schema): Schema
    {
        return OUForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OUSTable::configure($table);
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
            'index' => ListOUS::route('/'),
            'create' => CreateOU::route('/create'),
            'edit' => EditOU::route('/{record}/edit'),
        ];
    }
}
