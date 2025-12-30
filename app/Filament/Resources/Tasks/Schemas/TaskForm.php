<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Models\TaskCategory;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Task Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description such as IP address or Host Name or Tag')
                    ->rows(3),

                Select::make('task_category_id')
                    ->label('Category')
                    ->options(TaskCategory::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }
}
