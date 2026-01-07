<?php



namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Actions\BulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Spatie\Activitylog\Models\Activity;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn\FontWeight;




class AuditPage extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected string $view = 'filament.pages.audit-page';
    protected static ?string $navigationLabel = 'Audit Logs';
    //protected static ?string $navigationGroup = 'Administration';

    protected static ?string $recordTitleAttribute = 'Auditing';

    protected static string | UnitEnum | null $navigationGroup = 'Asset Audit';


    protected function getTableQuery()
    {
        return Activity::query()->latest();
    }


    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete_before_date')
                ->label('Delete Logs Before Date')
                ->form([
                    DatePicker::make('before_date')
                        ->label('Before Date')
                        ->required(),
                ])
                ->action(function (array $data) {
                    Activity::whereDate('created_at', '<', $data['before_date'])
                        ->delete();
                })
                ->requiresConfirmation()
                ->modalHeading('Confirm Deletion')
                ->modalSubheading('This will permanently delete all audit logs before the selected date.')
                ->color('danger'),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('causer_full_name')
                ->label('User')
                ->getStateUsing(fn($record) => $record->causer
                    ? trim("{$record->causer->fname} {$record->causer->mname} {$record->causer->lname}")
                    : '-')
                ->searchable()
                ->sortable()
                ->extraAttributes([
                    'class' => 'font-bold',
                ]),

            TextColumn::make('description')->label('Action')->wrap(),
            TextColumn::make('subject_type')->label('Model')->wrap(),
            TextColumn::make('subject_id')->label('Record ID'),
            TextColumn::make('created_at')->label('Date')->dateTime()->sortable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('subject_type')
                ->label('Model')
                ->options(Activity::query()->pluck('subject_type', 'subject_type')->unique()->toArray()),
        ];
    }


    protected function getTableSearchableColumns(): array
    {
        return ['description', 'causer.name', 'subject_type'];
    }
}
