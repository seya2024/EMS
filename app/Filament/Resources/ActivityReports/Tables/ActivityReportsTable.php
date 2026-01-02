<?php

namespace App\Filament\Resources\ActivityReports\Tables;

use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Foundation\Auth\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ReplicateAction;
use Filament\Actions\DeleteBulkAction;
use Spatie\Permission\Traits\HasRoles;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class ActivityReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('task.name')->label('Activity Name')->sortable()->searchable(),
                TextColumn::make('deliverable.outcome')->label('Deliverable')->sortable()->searchable(),
                TextColumn::make('taskGiver.name')->label('Task Giver')->sortable()->searchable(),
                TextColumn::make('district.name')->label('District')->sortable()->searchable(),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Completed',
                        'warning' => 'In Progress',
                        'danger' => 'Pending',
                    ]),

                // TextColumn::make('status')
                //     ->label('Status')
                //     ->badge() // renders as colored badge
                //     ->formatStateUsing(fn($state) => match ($state) {
                //         'pending' => 'Pending',
                //         'completed' => 'Completed',
                //         default => $state,
                //     })
                //     ->color(fn($state) => match ($state) {
                //         'pending' => 'primary',
                //         'completed' => 'success',
                //         default => 'secondary',
                //     }),

                TextColumn::make('report_date')->date(),
                // TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('task_id')->label('Task')->relationship('task', 'name'),
                SelectFilter::make('deliverable_id')->label('Deliverable')->relationship('deliverable', 'outcome'),
                SelectFilter::make('task_giver_id')->label('Task Giver')->relationship('taskGiver', 'name'),
                SelectFilter::make('district_id')->label('District')->relationship('district', 'name'),
                SelectFilter::make('status')->options([
                    'Pending' => 'Pending',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                ]),


                Filter::make('open_date_range')
                    ->form([
                        DatePicker::make('open_date_from')->label('Start date'),
                        DatePicker::make('open_date_to')->label('End date'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['open_date_from']) {
                            $query->whereDate('open_date', '>=', $data['open_date_from']);
                        }
                        if ($data['open_date_to']) {
                            $query->whereDate('open_date', '<=', $data['open_date_to']);
                        }
                    })
                    ->label('Open Date Range'),

            ])
            ->recordActions([
                ViewAction::make(),     // view record
                EditAction::make()->hidden(fn($record) => $record->status === 'Completed')->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                DeleteAction::make()->hidden(fn($record) => $record->status === 'Completed')->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ReplicateAction::make()->hidden(fn($record) => $record->status === 'Completed')->visible(fn() => Filament::auth()->user()?->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ]),
            ]);
    }
}
