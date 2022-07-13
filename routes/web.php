<?php

use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ArtCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\ExhibitionCategoryController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ExhibitionSchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Roles\PermissionController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Roles\UserController;
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

Route::get('/', [FrontController::class, 'index'])->name('welcome');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    /* Roles */
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::resource('roles', RolesController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);

    /* Exhibition Backend */
    Route::get('exhibitors', [ExhibitorController::class, 'index'])->name('exhibitor.index');
    Route::get('exhibitor/participants/{id}', [ExhibitorController::class, 'single'])->name('exhibitor.single');
    Route::delete('exhibitor/participants/delete/{id}', [ExhibitorController::class, 'destroy'])->name('exhibitor.destroy');

    /* Exhibition category backend */
    Route::resource('category', ExhibitionCategoryController::class)->except(['show', 'create']);

    /* Exhibition school backend */
    Route::resource('school', ExhibitionSchoolController::class)->except(['show', 'create']);

    /* Exhibitions */
    Route::resource('exhibition', ExhibitionController::class)->except(['show', 'create']);

    /* Artist */
    Route::resource('artist', ArtistController::class);

    /* Art categories */
    Route::resource('art-categories', ArtCategoryController::class);

    // Main Category
    Route::resource('main-category', CategoryController::class);
    Route::resource('student', StudentController::class);
    Route::resource('instructor', InstructorController::class);

    /* General Setting */
    Route::get('general-settings/logo', [GeneralSettingController::class, 'logo'])->name('general-setting.logo');
    Route::get('general-settings/favicon', [GeneralSettingController::class, 'favicon'])->name('general-setting.favicon');
    Route::get('general-settings/breadcrumb', [GeneralSettingController::class, 'breadcrumb'])->name('general-setting.breadcrumb');
    Route::get('general-settings/contents', [GeneralSettingController::class, 'contents'])->name('general-setting.contents');
    Route::get('general-settings/status/{field}/{status}', [GeneralSettingController::class, 'status'])->name('general-setting.status');
    Route::get('general-settings/certificate', [GeneralSettingController::class, 'certificate'])->name('general-setting.certificate');
    Route::get('general-settings/certificate/show', [GeneralSettingController::class, 'certificate_show'])->name('general-setting.certificate-show');
    Route::get('general-settings/error-banner', [GeneralSettingController::class, 'error_banner'])->name('general-setting.error');
    Route::post('general-settings/update', [GeneralSettingController::class, 'generalUpdate'])->name('general-setting.update');
});

// Exhibition Frontend
Route::get('exhibitor/registration', [ExhibitorController::class, 'create'])->name('exhibitor.create');
Route::post('exhibitor/registration', [ExhibitorController::class, 'store'])->name('exhibitor.store');
Route::get('exhibitor/registration/{id}', [ExhibitorController::class, 'show'])->name('exhibitor.show');
Route::get('exhibitor/registration/pdf/{id}', [ExhibitorController::class, 'pdf'])->name('exhibitor.pdf');

require __DIR__.'/auth.php';