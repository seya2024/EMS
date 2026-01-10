<?php

namespace App\Filament\Resources\AssetAssignments;

use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\AssetAssignment;
use Pages\ListAssetAssignments;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\AssetAssignmentResource\Pages;
use UnitEnum;

use Filament\Tables;

use App\Filament\Resources\AssetAssignments\Pages\ManageAssetAssignments;

class AssetAssignmentResource extends Resource
{
    protected static ?string $model = AssetAssignment::class;

    protected static ?string $navigationLabel = 'Asset Custody History';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;


    protected static ?string $recordTitleAttribute = 'Asset Assigment';

    protected static string | UnitEnum | null $navigationGroup = 'Asset Audit';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Asset Assigment')->required()
                    ->maxLength(255),




            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                // TextColumn::make('assetable_type')->label('Asset Type')->formatStateUsing(fn($state) => class_basename($state))->sortable(),


                TextColumn::make('assetable_type')
                    ->label('Asset Tag')
                    ->formatStateUsing(fn($state, $record) => $record->assetable?->display_name ?? '-')
                    ->sortable(),


                TextColumn::make('assetable.branch.name')
                    ->label('Cost center')
                    ->sortable(),



                TextColumn::make('assetable_id')->label('Asset ID')->sortable(),
                TextColumn::make('user.full_name')->label('Assigned To'),
                TextColumn::make('assignedBy.full_name')->label('Assigned By'),
                TextColumn::make('returnedBy.full_name')->label('Returned By'),
                TextColumn::make('assigned_at')->dateTime(),
                TextColumn::make('returned_at')->dateTime(),
                TextColumn::make('condition_out'),
                TextColumn::make('condition_in'),

            ])
            ->defaultSort('assigned_at', 'desc')
            ->actions([])          // no row actions
            ->bulkActions([]);     // no bulk actions
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    // public static function getPages(): array
    // {
    //     return [
    //         'index' => ListAssetAssignments::route('/'),
    //     ];
    // }


    public static function getPages(): array
    {
        return [
            'index' => ManageAssetAssignments::route('/'),
        ];
    }
}
