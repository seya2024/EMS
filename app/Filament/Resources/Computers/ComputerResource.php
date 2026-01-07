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
use Filament\Schemas\Components\Section;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\ComputerExporter;
use App\Filament\Imports\ComputerImporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Pages\Dashboard\Actions\FilterAction;
use App\Filament\Resources\Computers\Pages\EditComputer;
use App\Filament\Resources\Computers\Pages\ViewComputer;
use App\Filament\Resources\Computers\Pages\ListComputers;
use App\Filament\Resources\Computers\Pages\CreateComputer;
use App\Filament\Resources\Computers\Schemas\ComputerForm;
use App\Filament\Resources\Computers\Tables\ComputersTable;
use App\Filament\Resources\Computers\Schemas\ComputerInfolist;



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


    public static function getFormValidationMessages(): array
    {
        return [
            'tagNo.unique'     => 'The tag number has already been used.',
            'serialNo.unique'  => 'The serial number must be unique.',
            'IpAddress.unique' => 'This IP address is already assigned.',
            'hostName.unique'  => 'This host name is already taken.',
        ];
    }



    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            /* ========= Branch ========= */
            Section::make('Branch Information')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('code'),
                    TextEntry::make('region'),
                    TextEntry::make('district'),
                    TextEntry::make('status'),
                ])
                ->columns(3),

            /* ========= Computers ========= */
            Section::make('Computers')
                ->schema([
                    RepeatableEntry::make('computers')
                        ->schema([
                            TextEntry::make('tagNo'),
                            TextEntry::make('serialNo'),
                            TextEntry::make('os'),
                            TextEntry::make('ramSize'),
                            TextEntry::make('status'),
                        ])
                        ->columns(5),
                ])
                ->collapsed(),

            /* ========= Printers ========= */
            Section::make('Printers')
                ->schema([
                    RepeatableEntry::make('printers')
                        ->schema([
                            TextEntry::make('model'),
                            TextEntry::make('tag'),
                            TextEntry::make('status'),
                        ])
                        ->columns(3),
                ])
                ->collapsed(),

            /* ========= POS ========= */
            Section::make('POS Devices')
                ->schema([
                    RepeatableEntry::make('posDevices')
                        ->schema([
                            TextEntry::make('model'),
                            TextEntry::make('tag'),
                            TextEntry::make('serial'),
                            TextEntry::make('merchant'),
                        ])
                        ->columns(4),
                ])
                ->collapsed(),

            /* ========= ATMs ========= */
            Section::make('ATMs')
                ->schema([
                    RepeatableEntry::make('atms')
                        ->schema([
                            TextEntry::make('terminal'),
                            TextEntry::make('os'),
                            TextEntry::make('type'),
                            TextEntry::make('location'),
                        ])
                        ->columns(4),
                ])
                ->collapsed(),

            /* ========= Data VPN ========= */
            Section::make('Data VPN')
                ->schema([
                    RepeatableEntry::make('dataVpns')
                        ->schema([
                            TextEntry::make('serviceNo'),
                            TextEntry::make('lANIp'),
                            TextEntry::make('wanIp'),
                            TextEntry::make('bandwidth'),
                        ])
                        ->columns(4),
                ])
                ->collapsed(),

            /* ========= Dongles ========= */
            Section::make('Dongles')
                ->schema([
                    RepeatableEntry::make('dongles')
                        ->schema([
                            TextEntry::make('model'),
                            TextEntry::make('serial'),
                            TextEntry::make('imei'),
                            TextEntry::make('status'),
                        ])
                        ->columns(4),
                ])
                ->collapsed(),

            /* ========= DOB ========= */
            Section::make('DOBs')
                ->schema([
                    RepeatableEntry::make('dobs')
                        ->schema([
                            TextEntry::make('model'),
                            TextEntry::make('serial'),
                            TextEntry::make('service_no'),
                            TextEntry::make('status'),
                        ])
                        ->columns(4),
                ])
                ->collapsed(),

            /* ========= Fixed Lines ========= */
            Section::make('Fixed Lines')
                ->schema([
                    RepeatableEntry::make('fixedLines')
                        ->schema([
                            TextEntry::make('serviceNo'),
                            TextEntry::make('account'),
                            TextEntry::make('media'),
                        ])
                        ->columns(3),
                ])
                ->collapsed(),

            /* ========= Other Assets ========= */
            Section::make('Other Assets')
                ->schema([
                    RepeatableEntry::make('otherAssets')
                        ->schema([
                            TextEntry::make('asset_number'),
                            TextEntry::make('asset_cost'),
                            TextEntry::make('assigned_to'),
                        ])
                        ->columns(3),
                ])
                ->collapsed(),

        ]);
    }


    public static function table(Table $table): Table
    {
        return ComputersTable::configure($table)

            ->filters([
                // District filter
                SelectFilter::make('district_id')
                    ->label('District')
                    ->options(District::pluck('name', 'id')->toArray())
                    ->query(
                        fn($query, $districtId) => $districtId
                            ? $query->whereHas('branch', fn($q) => $q->where('district_id', $districtId))
                            : null
                    ),

                // Branch filter depending on district
                SelectFilter::make('branch_id')
                    ->label('Branch')
                    ->options(function (SelectFilter $filter) {
                        // get current district filter value
                        $districtId = $filter->getState()['district_id'] ?? null;

                        return Branch::when($districtId, fn($q) => $q->where('district_id', $districtId))
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->query(
                        fn($query, $branchId) => $branchId
                            ? $query->where('branch_id', $branchId)
                            : null
                    ),

            ], layout: FiltersLayout::AboveContent)

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



            ]);
    }



    public static function getRelations(): array
    {
        return [
            // AtmsRelationManager::class,
            // ComputersRelationManager::class,
            // DataVpnsRelationManager::class,
            // DonglesRelationManager::class,
            // DobsRelationManager::class,
            // FixedLinesRelationManager::class,
            // OtherAssetsRelationManager::class,
            // OutletsRelationManager::class,
            // PhotocopiesRelationManager::class,
            // PosRelationManager::class,
            // PrintersRelationManager::class,
            // ScannersRelationManager::class,
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
