<?php

namespace App\Filament\Resources\DataVPNS;

use UnitEnum;
use BackedEnum;
use App\Models\DataVPN;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Support\Icons\Heroicon;
use Filament\Support\Enums\Alignment;
//use Filament\Tables\Actions\FilterAction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Pages\Dashboard\Actions\FilterAction;
use App\Filament\Resources\DataVPNS\Pages\EditDataVPN;
use App\Filament\Resources\DataVPNS\Pages\ListDataVPNS;
use App\Filament\Resources\DataVPNS\Pages\CreateDataVPN;

use App\Filament\Resources\DataVPNS\Schemas\DataVPNForm;
use App\Filament\Resources\DataVPNS\Tables\DataVPNSTable;


class DataVPNResource extends Resource
{
    protected static ?string $model = DataVPN::class;
    public $defaultAction = 'onboarding';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'DataVPN';


    protected static string | UnitEnum | null $navigationGroup = 'Subscriptions';

    protected static ?string $title = 'Data VPN Subsription List';



    protected ?Alignment $headerActionsAlignment = Alignment::End;

    public static function form(Schema $schema): Schema
    {
        return DataVPNForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataVPNSTable::configure($table)
            ->headerActions([
                CreateAction::make()
                    ->label('Add Subscription'),

                ExportAction::make('export')
                    ->label('Export Data'),

                FilterAction::make('filter')
                    ->label('Filter Data'),
            ]);
    }





    // public function onboardingAction(): Action
    // {
    //     return Action::make('onboarding')
    //         ->modalHeading('Welcome')
    //         ->visible(fn(): bool => ! auth()->user()->isOnBoarded());
    // }


    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::class
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    // protected static function getCreateButtonLabel(): string
    // {
    //     return 'Add New Item';
    // }



    public static function getPages(): array
    {
        return [
            'index' => ListDataVPNS::route('/'),
            // 'create' => CreateDataVPN::route('/create'),
            // 'edit' => EditDataVPN::route('/{record}/edit'),
        ];
    }
}
