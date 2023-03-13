<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\Theme\ColorSchemeController;
use App\Http\Controllers\Dashboard\Theme\DarkModeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GlobalSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');


Route::get('/eplastic', function () {
    return view('withoutLogin.welcome');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::group(['middleware' => AdminMiddleware::class], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('logout', [AdminController::class, 'logout'])->name('dashboard.logout');
        Route::resource('role', RoleController::class, ['names' => 'dashboard.role']);
        Route::resource('admin', AdminController::class, ['names' => 'dashboard.admin']);
        Route::resource('profile', ProfileController::class, ['names' => 'dashboard.profile']);
        Route::resource('global-settings', GlobalSettingController::class, ['names' => 'dashboard.global-settings']);
        Route::post('global-setting_update', [GlobalSettingController::class, 'updateGlobal'])->name('dashboard.global-setting.update');
        Route::get('roles/list', [RoleController::class, 'list'])->name('dashboard.roles.list');
        Route::get('admins/list', [AdminController::class, 'list'])->name('dashboard.admins.list');
        Route::get('change-password', [ProfileController::class,'changePassword'])->name('dashboard.profile.changePassword');
        Route::post('change-password/submit', [ProfileController::class,'changePasswordPost'])->name('dashboard.profile.changePassword.submit');
    });
    Route::group(['middleware' => CheckAdmin::class], function () {
        Route::get('registration', [UserController::class, 'registrationFromView'])->name('registration');
        Route::post('registration', [UserController::class, 'registrationPost'])->name('registration.store');
        Route::get('login', [AdminController::class, 'showLoginForm'])->name('dashboard.login');
        Route::post('login', [AdminController::class, 'login'])->name('dashboard.loginPost');


        /*/////////////////////////////////////////////////////////////////////////////////////////////////*/
        Route::get('forgot-password', [AdminController::class, 'forgotPassword'])->name('dashboard.forgot-password');
        Route::post('forgot-password/submit', [AdminController::class, 'resetPassword'])->name('dashboard.forgot-password.submit');
        Route::get('reset-password/{token}', [AdminController::class, 'resetPasswordForm'])->name('dashboard.Reset_password');
        Route::post('reset-password/submit', [AdminController::class, 'resetPasswordUpdate'])->name('dashboard.reset_password_submit');
    });
});

