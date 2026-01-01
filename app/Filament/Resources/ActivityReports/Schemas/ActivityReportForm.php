<?php

namespace App\Filament\Resources\ActivityReports\Schemas;

use App\Models\Deliverable;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class ActivityReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('task_id')
                    ->label('Task')
                    ->relationship('task', 'name')
                    ->required() //->searchable()
                    ->reactive(), // needed for dependent deliverable select



                Select::make('deliverable_id')
                    ->label('Deliverable/Outcome')
                    ->required()
                    ->reactive() // <- this makes the select update when task_id changes
                    ->options(function (callable $get) {
                        $taskId = $get('task_id');
                        if (!$taskId) {
                            return [];
                        }
                        return Deliverable::where('task_id', $taskId)
                            ->pluck('outcome', 'id')
                            ->toArray();
                    })->searchable(),

                Select::make('task_giver_id')
                    ->label('Task Giver')
                    ->relationship('taskGiver', 'name')
                    ->required(),

                Select::make('district_id')
                    ->label('Where you are working for?')
                    ->relationship('district', 'name')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'Pending' => 'Pending',
                        'In Progress' => 'In Progress',
                        'Completed' => 'Completed',
                    ])
                    ->placeholder('Select status'),

                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(255),

                DatePicker::make('report_date')
                    ->label('Date of task handling')
                    ->required(),
            ]);
    }
}
