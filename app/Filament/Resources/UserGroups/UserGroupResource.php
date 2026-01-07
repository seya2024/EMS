<?php

namespace App\Filament\Resources\UserGroups;

use UnitEnum;
use BackedEnum;
use App\Models\UserGroup;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Illuminate\Support\HtmlString;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserGroups\Pages\EditUserGroup;
use App\Filament\Resources\UserGroups\Pages\ListUserGroups;
use App\Models\User;
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
        return UserGroupForm::configure($schema); //->authorize(fn(User $user, $record) => $user->can('update', 'create', $record));
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


                TextColumn::make('serial')
                    ->label('#')
                    ->getStateUsing(fn($record, $column) => $column->getTable()->getRecords()->search($record) + 1)
                    ->sortable(false),

                TextColumn::make('description')->label('Name of group')
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

                ViewAction::make('viewUsers')
                    ->label('View Users')
                    ->icon('heroicon-o-users')
                    ->modalHeading(fn($record) => "List of Users in {$record->name} group")
                    ->modalContent(fn($record) => new HtmlString(
                        '<ul>' .
                            $record->users->pluck('full_name')
                            ->map(fn($name) => "<li> -<strong>{$name}</strong></li>")
                            ->implode('') .
                            '</ul>'
                    )),

                // View Permissions button
                ViewAction::make('viewPermissions')
                    ->label('Permissions')
                    ->icon('heroicon-o-shield-check')
                    ->modalHeading(fn($record) => "Permissions for {$record->name}")
                    ->modalContent(fn($record) => new HtmlString(
                        $record->permissions->pluck('name')->implode('<br>')
                    )),


                //  ViewAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                EditAction::make(), //->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                DeleteAction::make(), //->rateLimit(5)->rateLimitedNotificationTitle('Slow down!'),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Filament::auth()->user()?->role === 'admin'),
                ]),
            ])->defaultSort('id', 'desc');
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
