<?php

namespace App\Filament\Resources\Computers;

use UnitEnum;
use BackedEnum;
use App\Models\Branch;
use App\Models\Computer;
use App\Models\District;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Exports\ComputerExporter;
use App\Filament\Imports\ComputerImporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Pages\Dashboard\Actions\FilterAction;
use App\Filament\Resources\Computers\Pages\EditComputer;
use App\Filament\Resources\Computers\Pages\ViewComputer;
use App\Filament\Resources\Computers\Pages\ListComputers;
use App\Filament\Resources\Computers\Pages\CreateComputer;
use App\Filament\Resources\Computers\Schemas\ComputerForm;
use App\Filament\Resources\Computers\Tables\ComputersTable;
use App\Filament\Resources\Computers\Schemas\ComputerInfolist;
use Illuminate\Database\Eloquent\Builder;


class ComputerResource extends Resource
{
    protected static ?string $model = Computer::class;


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('computerModel'); // eager load related model
    }



    protected static ?string $navigationLabel = 'List of Computers';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static string | UnitEnum | null $navigationGroup = 'Fixed Assets';



    protected static ?string $recordTitleAttribute = 'Computer';

    public static function form(Schema $schema): Schema
    {
        return ComputerForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {

        return Computer::count();
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return ComputerInfolist::configure($schema);
    // }






    public static function table(Table $table): Table
    {
        return ComputersTable::configure($table)

            ->filters([

                // Filter by district (via branch relation)
                SelectFilter::make('district_id')
                    ->label('Filter by District')
                    ->options(District::pluck('name', 'id')->toArray())
                    ->query(
                        fn($query, $districtId) => $districtId
                            ? $query->whereHas('branch', fn($q) => $q->where('district_id', $districtId))
                            : null
                    ),

                // Filter by branch (direct)
                SelectFilter::make('branch_id')
                    ->label('Filter by Branch')
                    ->options(Branch::pluck('name', 'id')->toArray())
                    ->query(
                        fn($query, $branchId) => $branchId
                            ? $query->where('branch_id', $branchId)
                            : null
                    ),

            ], layout: FiltersLayout::AboveContent)







            //  SelectFilter::make('district_id')
            // ->label('Filter by District')


            //         ->options(District::all()->pluck('name', 'id'))
            //          ->searchable()
            //         ->reactive() // important for dependency
            //         ->required(),

            //     Select::make('district_id')
            //         ->label(' Branch')
            //         ->options(function ($get) {
            //             $districtId = $get('district_id');

            //             if (!$districtId) {
            //                 return Branch::pluck('name', 'id'); // all models if nothing selected
            //             }

            //             return Branch::where('district_id', $hardwareTypeId)
            //                 ->pluck('name', 'id');
            //         })
            //         ->searchable()
            //         ->required()









            ->headerActions([

                ImportAction::make()
                    ->label('Import CSV')->icon(Heroicon::ArrowDownTray)->color('secondary')
                    ->label('Import Data')
                    ->importer(ComputerImporter::class),

                ExportAction::make('export')
                    ->label('Export Data')
                    ->icon(Heroicon::CloudArrowUp)
                    ->color('secondary')
                    ->exporter(ComputerExporter::class)->icon(Heroicon::ArrowUpTray)->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ])->fileName(fn(Export $export): string => "Computer Inventory-{$export->getKey()}"),


                // CreateAction::make()
                //     ->label('Add Computer')
                //     ->color('primary')
                //     ->icon(Heroicon::Plus),





                // FilterAction::make('filter')   // just a button to toggle filters
                //     ->label('Filter Data')
                //     ->color('success')
                //     ->icon(Heroicon::Funnel),



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
            'index' => ListComputers::route('/'),
            // 'create' => CreateComputer::route('/create'),
            // 'view' => ViewComputer::route('/{record}'),
            // 'edit' => EditComputer::route('/{record}/edit'),
        ];
    }
}
