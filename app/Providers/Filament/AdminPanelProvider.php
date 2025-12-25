<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Support\Icons\Heroicon;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use function Filament\Support\original_request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Filament\Navigation\Concerns\HasExtraSidebarAttributes;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Actions\Action;
use Filament\Pages\Settings;


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
            ->registration()



            ->profile(isSimple: false)
            //->authGuard('web')
            //->revealablePasswords(false)
            ->emailVerification()
            ->emailChangeVerification()
            // ->profile()

            // ->domain('dashenbank.local')

            ->subNavigationPosition(SubNavigationPosition::Top)
            ->spa()
            ->spa(hasPrefetching: true)
            ->unsavedChangesAlerts()
            ->databaseTransactions(false)

            //      ->middleware([
            //     // ...
            // ])

            ->userMenuItems([
                'profile' => fn(Action $action) => $action->label('Edit profile'),
                // ...
            ])


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

            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->brandLogo(asset('images/logo.jpg'))
            ->brandLogoHeight('4rem')

            //->brandName('Inventory-Managment-System ')
            ->login()->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
