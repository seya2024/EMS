<?php

namespace App\Filament\Resources\Users;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;


use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Filament\Resources\Users\Schemas\UserInfolist;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'List of users';

    //protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;

    protected static string|UnitEnum|null $navigationGroup = 'User Account';

    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {
        // Get the existing schema from UserForm
        $formSchema = UserForm::configure($schema);

        // Add hidden password field
        $formSchema->schema([

            TextInput::make('name')->label('Domain')->required()->unique(ignoreRecord: true),

            TextInput::make('fname')->label('First Name')->required(),
            TextInput::make('mname')->label('Father Name')->required(),
            TextInput::make('lname')->label('Last Name')->required(),
            TextInput::make('email')->label('Email address')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('phone')->tel()->required(),
            TextInput::make('address')->maxLength(255),
            Select::make('branch_id')->label('Working Unit / Department')->required(true)->relationship('branch', 'name')->searchable()->preload(),
            //   Hidden::make('role')->default('admin'),
            TextInput::make('employee_id')->label('Employee ID')->required()->placeholder('DB/17357/24')->unique(ignoreRecord: true),
            Toggle::make('isActive')->label('Active Account')->default(false)->onIcon(Heroicon::Star),

            // TextInput::make('password')->password()->hidden(), // hidden field
        ]);

        return $formSchema;
    }


    public static function getNavigationBadge(): ?string
    {

        return User::count();
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['password'])) {
            $data['password'] = Hash::make('123'); // default password
        }

        if (!isset($data['isActive'])) {
            $data['isActive'] = 1; // ensure user can login
        }

        return $data;
    }

    // public static function shouldRegisterNavigation(): bool | \Closure
    // {
    //     return auth()->check() && auth()->user()->role === 'admin';
    // }

    // protected static function shouldRegisterNavigation(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table)

            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn(Builder $query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn(Builder $query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
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
            'index' => ListUsers::route('/'),
            // 'create' => CreateUser::route('/create'),
            // 'view' => ViewUser::route('/{record}'),
            // 'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
