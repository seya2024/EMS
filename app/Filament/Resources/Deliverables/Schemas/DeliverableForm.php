<?php

namespace App\Filament\Resources\Deliverables\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\Task;

class DeliverableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('outcome')
                    ->label('Outcome')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
