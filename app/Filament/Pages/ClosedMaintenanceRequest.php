<?php

namespace App\Filament\Pages;


use UnitEnum;
use Filament\Tables;
use Filament\Pages\Page;
use App\Models\AssetMaintenance;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use BackedEnum;


class ClosedMaintenanceRequest extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected string $view = 'filament.pages.closed-maintenance-request';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static ?string $navigationLabel = 'Closed requests';
    protected static string | UnitEnum | null $navigationGroup = 'Support';


    // Fetch only closed maintenance requests
    // protected function getTableQuery()
    // {
    //     return AssetMaintenance::query()
    //         ->where('status', 'CLOSED')
    //         ->with(['ou', 'branch']); // optional, if you have relationships
    // }


    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return AssetMaintenance::query()->where('status', 'CLOSED');
    }



    public static function getNavigationBadge(): ?string
    {
        return (string) AssetMaintenance::where('status', 'CLOSED')->count();
    }


    // Define columns to display
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('assetable_type')->label('Asset Type'),
            TextColumn::make('assetable_id')->label('Asset ID'),
            TextColumn::make('branch_id')->label('Sent from'),
            TextColumn::make('ou_id')->label('Sent to'),
            TextColumn::make('problem')->label('Problem')->limit(50),
            TextColumn::make('sent_date')->label('Sent Date')->date(),
            TextColumn::make('return_date')->label('Return Date')->date(),
            TextColumn::make('status')
                ->badge()
                ->colors([
                    'primary' => fn($state) => $state === 'SENT',
                    'warning' => fn($state) => $state === 'RECEIVED',
                    'info' => fn($state) => $state === 'IN_PROGRESS',
                    'success' => fn($state) => $state === 'CLOSED',
                ])
                ->sortable(),
        ];
    }

    // Actions - optional, for closed we usually remove edit/delete
    protected function getTableActions(): array
    {
        return [];
    }

    public function getViewData(): array
    {
        return [
            'closedRequests' => AssetMaintenance::where('status', 'CLOSED')->get(),
        ];
    }
}
