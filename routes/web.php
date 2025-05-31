<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\tontiflex\user\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\tontiflex\auth\forgotpasswordController;
use App\Http\Controllers\tontiflex\auth\loginController;
use App\Http\Controllers\tontiflex\auth\registerController;
use App\Http\Controllers\tontiflex\dashboard\AnalyticsController;
use App\Http\Controllers\tontiflex\invitation\InvitationController;
use App\Http\Controllers\tontiflex\settings\SettingsController;
use App\Http\Controllers\tontiflex\tontine\TontineController;
use App\Http\Controllers\tontiflex\tontineview\TontineViewController;
use App\Http\Controllers\tontiflex\wallet\WalletController;

// Tontiflex

Route::get('/', [AnalyticsController::class, 'index'])->name('dashboard-analytics'); // Main Page Route


// Routes publiques
Route::middleware('guest')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::get('/login', [loginController::class, 'index'])->name('auth-login');
        Route::post('/login', [loginController::class, 'login'])->name('auth.login');
        Route::get('/register', [registerController::class, 'index'])->name('auth-register');
        Route::post('/register', [registerController::class, 'register'])->name('auth.register');
        Route::get('/forgot-password', [forgotpasswordController::class, 'index'])->name('auth-forgot-password');
    });
});

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/', [AnalyticsController::class, 'index'])->name('dashboard-analytics');

    Route::prefix('user')->group(function () {
        Route::get('/update/{id}', [UserController::class, 'index'])->name('user-update');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    });


    Route::prefix('/dashboard')->group(function () {
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('dashboard-analytics');
    });

    Route::prefix('/account')->group(function () {
        Route::get('/settings-account', [SettingsController::class, 'account'])->name('account-settings-account');
        Route::put('/settings-account/{id}', [SettingsController::class, 'update'])->name('account.settings.account.update');

        Route::get('/settings-notifications', [SettingsController::class, 'notification'])->name('account-settings-notifications');
        Route::put('/settings-notifications/{id}', [SettingsController::class, 'updatenotificationauthorization'])->name('account.settings.notifications');
        
        Route::get('/settings-connections', [SettingsController::class, 'connection'])->name('account-settings-connections');

        Route::get('/user/wallet', [SettingsController::class, 'wallet'])->name('account-settings-wallet');
        Route::put('/settings-wallet/{id}', [SettingsController::class, 'walletupdate'])->name('account.settings.wallet.walletupdate');

    });


    Route::prefix('/tontines')->group(function () {
        Route::get('/dashboard', [TontineController::class, 'index'])->name('tontines-dashboard');;
        Route::get('/tontines', [TontineController::class, 'tontinecreatevew'])->name('tontines-tontines');;
        Route::put('/tontines/{id}', [TontineController::class, 'update'])->name('tontines-modify');;

        Route::get('/archived', [TontineController::class, 'archived'])->name('tontines-archived');
        Route::post('/restore/{id}', [TontineController::class, 'restore'])->name('tontines.restore');
        Route::post('/forcedelete/{id}', [TontineController::class, 'deletePermanentlyTontine'])->name('tontines.forcedelete');

        Route::delete('/tontines/{id}', [TontineController::class, 'destroy'])->name('tontine.destroy');
        Route::get('/tontines/{id}', [TontineController::class, 'tontinecreatevew'])->name('tontine-destroy');

        Route::post('/', [TontineController::class, 'store'])->name('my.tontine');
    });

    // Route de déconnexion
    Route::prefix('/auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth-logout');
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    // Route de Invitations
    Route::prefix('/invitations')->group(function () {
        Route::get('/dashboard', [InvitationController::class, 'index'])->name('invitations-dashboard');
        Route::get('/mes-invitations', [InvitationController::class, 'invitations'])->name('invitations-mes-invitations');
        Route::post('/mes-invitations', [TontineController::class, 'addMemberToTontine'])->name('invitations.mes.invitations');
        
        
        Route::post('/refuse-invitation/{id}', [InvitationController::class, 'refuse'])->name('invitations.refuse.invitations');

        

        Route::post('/{id}', [InvitationController::class, 'store'])->name('invitations.send');
    });

    Route::prefix('/user')->name('wallet.')->group(function (){
        Route::resource('wallet',WalletController::class);
    });

    Route::prefix('/tontine-view')->group(function () {
        Route::get('{id}/main', [TontineController::class, 'show'])->name('tontine-view-main');
    });
});














//analytics

Route::get('/dashbord/analytics', [Analytics::class, 'index'])->name('dashboard-analytic');


// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
