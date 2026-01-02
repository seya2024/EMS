<?php

namespace App\Filament\Resources\UserGroups;

use UnitEnum;
use BackedEnum;
use App\Models\UserGroup;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserGroups\Pages\EditUserGroup;
use App\Filament\Resources\UserGroups\Pages\ListUserGroups;
use App\Filament\Resources\UserGroups\Pages\CreateUserGroup;
use App\Filament\Resources\UserGroups\Schemas\UserGroupForm;
use App\Filament\Resources\UserGroups\Tables\UserGroupsTable;

class UserGroupResource extends Resource
{
    protected static ?string $model = UserGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static ?string $recordTitleAttribute = 'name';


    protected static string|UnitEnum|null $navigationGroup = 'User Account';

    public static function form(Schema $schema): Schema
    {
        return UserGroupForm::configure($schema);
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) UserGroup::count();
    }

    public static function table(Table $table): Table
    {
        //  return UserGroupsTable::configure($table);

        return $table
            ->columns([
                TextColumn::make('name')->label('Name of group')
                    ->searchable()
                    ->sortable(),



                TextColumn::make('users')
                    ->label('Users in this group')
                    ->getStateUsing(
                        fn($record) =>
                        $record->users->map(fn($user) => "{$user->fname} {$user->mname} {$user->lname}")->toArray()
                    )
                    ->listWithLineBreaks()   // vertical list
                    ->limit(30)              // show first 30 users
                    ->wrap(),



                TextColumn::make('users_count')
                    ->label('No of users')
                    ->counts('users')
                    ->sortable(),

            ])

            ->recordActions([
                ViewAction::make(),  // default view page
                EditAction::make(),

                ViewAction::make('view_users')
                    ->label('View Users')
                    ->icon('heroicon-o-users')
                    ->action(function ($record, $data, $livewire) {
                        $users = $record->users; // get related users
                        $userNames = $users->pluck('name')->join(', ');

                        // simple alert popup (quick demo)
                        $livewire->notify('info', "Users: {$userNames}");
                    }),
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
            'index'  => ListUserGroups::route('/'),
            // 'create' => CreateUserGroup::route('/create'),
            // 'edit'   => EditUserGroup::route('/{record}/edit'),
        ];
    }
}
