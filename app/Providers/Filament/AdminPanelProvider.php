<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Pages\Auth\Register;
use Filament\PanelProvider;
use App\Filament\Pages\Home;
use Filament\Actions\Action;
use Filament\Pages\Settings;
use Laravel\Fortify\Fortify;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Auth\Pages\EditProfile;
use Filament\Support\Icons\Heroicon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Filament\Widgets\ComputerChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Navigation\NavigationItem;
//use Dotenv\Exception\ValidationException;
use Filament\Navigation\NavigationGroup;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Validation\ValidationException;
use Filament\Pages\Enums\SubNavigationPosition;
use function Filament\Support\original_request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Filament\Navigation\Concerns\HasExtraSidebarAttributes;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;



class AdminPanelProvider extends PanelProvider
{



    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->topNavigation()
            ->id('admin')
            ->path('admin')
            ->passwordReset()

            ->login()
            // ->registration(Pages\Auth\Register::class),
            // ->registration()
            ->profile(isSimple: false)
            //->authGuard('web')
            //->revealablePasswords(false)
            ->emailVerification()
            ->emailChangeVerification()
            // ->profile()
            // ->registration()
            // ->passwordReset()
            // ->emailVerification()
            // ->emailChangeVerification()
            // ->domain('dashenbank.local')
            ->profile(EditProfile::class)
            ->subNavigationPosition(SubNavigationPosition::Top)
            ->spa()
            ->spa(hasPrefetching: false)
            ->unsavedChangesAlerts()
            ->databaseTransactions(false)
            //      ->middleware([
            //     // ...
            // ])
            ->userMenuItems([
                'profile' => fn(Action $action) => $action->label('Edit profile'),
                // ...
            ])
            // ->multiFactorAuthentication([
            //     EmailAuthentication::make()
            //         ->codeExpiryMinutes(2), // code valid for 2 minutes
            // ], isRequired: app()->environment('production')) // required only in production

            // ->multiFactorAuthentication([
            //     AppAuthentication::make(),
            // ], isRequired: false)

            ->registerErrorNotification(
                title: 'An error occurred',
                body: 'Please try again later.',
            )

            ->registerErrorNotification(
                title: 'Record not found',
                body: 'A record you are looking for does not exist.',
                statusCode: 404,
            )
            // ->collapsibleNavigationGroups(false)
            // ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->brandLogo(asset('images/logo.jpg'))
            ->brandLogoHeight('4rem')

            ->colors(['success' => '#16a34a',])
            //->brandName('Inventory-Managment-System ')
            ->login()->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')

            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            // ->pages([Dashboard::class,])

            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            // ->pages([Dashboard::class])

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([Home::class,])



            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,

                // StatsOverview::class,
                // ComputerChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])->authMiddleware([Authenticate::class,]);
    }

    public function pages(): array
    {
        return [
            Home::class,
        ];
    }
    public function boot(): void
    {
        // // Custom login for Filament
        // Fortify::authenticateUsing(function ($request) {
        //     $user = User::where('email', $request->email)->first();

        //     if ($user && Hash::check($request->password, $user->password)) {
        //         if (!$user->isActive) {
        //             throw ValidationException::withMessages([
        //                 'email' => ['Your account is inactive.'], // <-- array here
        //             ]);
        //         }
        //         return $user;
        //     }
        // });
    }
}
