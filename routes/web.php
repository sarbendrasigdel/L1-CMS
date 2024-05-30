<?php

use App\Http\Controllers\Admins\Access\AdminUserController;
use App\Http\Controllers\Admins\Access\DesignationController;
use App\Http\Controllers\Admins\Access\RoleController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\Updated\HomepageController;
use App\Http\Controllers\Admins\Updated\TeamController;
use App\Http\Controllers\Admins\Settings\PrivacyPolicyController;
use App\Http\Controllers\Admins\Settings\SeoSettingController;
use App\Http\Controllers\Admins\Settings\SiteSettingController;
use App\Http\Controllers\Admins\Settings\TermsAndConditionController;
use App\Http\Controllers\Admins\Updated\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\Updated\HomeController;
use App\Http\Controllers\Admins\Updated\NewsletterController;
use App\Http\Controllers\Admins\Updated\PortfolioController;
use App\Http\Controllers\Admins\Updated\ServiceController;
use App\Http\Controllers\Admins\Updated\ServiceFeaturesController;
use NunoMaduro\Collision\Adapters\Laravel\Commands\TestCommand;

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

Route::get('clear', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'all clear';
});

Route::get('/', function () {
    return redirect(route('admin.login'));
})->name('frontend.index');

Route::get('/admin-login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [LoginController::class, 'authenticate'])->name('admin.login.submit');

Route::group(['middleware' => 'auth:admin-user'], function () {
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('admin-pw-change', [DashboardController::class, 'pwChange'])->name('admin-pw-change');
        Route::post('admin-pw-change', [DashboardController::class, 'updatePassword'])->name('update-password');

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        // Routes for role module
        Route::get('roles', [RoleController::class, 'index'])->name('roles')->middleware('permission:view.user.role');
        Route::post('roles', [RoleController::class, 'store'])->middleware('permission:create.user.role');
        Route::post('fetch-roles', [RoleController::class, 'fetchRolesLists'])->middleware('permission:view.user.role');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:view.user.role');
        Route::post('roles/{role}', [RoleController::class, 'update'])->middleware('permission:edit.user.role');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete.user.role');
        Route::get('roles/export', [RoleController::class, 'export'])->middleware('permission:export.user.role');

        // Routes for designation module
        Route::get('designations', [DesignationController::class, 'index'])->name('designations')->middleware('permission:view.user.designation');
        Route::post('designations', [DesignationController::class, 'store'])->middleware('permission:create.user.designation');
        Route::post('fetch-designations', [DesignationController::class, 'fetchDesignationLists'])->middleware('permission:view.user.designation');
        Route::get('designations/{designation}/edit', [DesignationController::class, 'edit'])->middleware('permission:view.user.designation');
        Route::post('designations/{designation}', [DesignationController::class, 'update'])->middleware('permission:edit.user.designation');
        Route::delete('designations/{designation}', [DesignationController::class, 'destroy'])->middleware('permission:delete.user.designation');
        Route::get('designations/export', [DesignationController::class, 'export'])->middleware('permission:export.user.designation');

        // Routes for user module
        Route::get('users', [AdminUserController::class, 'index'])->name('users')->middleware('permission:view.user');
        Route::post('users', [AdminUserController::class, 'store'])->middleware('permission:create.user');
        Route::post('fetch-users', [AdminUserController::class, 'fetchAdminUsers'])->middleware('permission:view.user');
        Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->middleware('permission:view.user');
        Route::post('users/{user}', [AdminUserController::class, 'update'])->middleware('permission:edit.user');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->middleware('permission:delete.user');
        Route::get('users/export', [AdminUserController::class, 'export'])->middleware('permission:export.user');
        Route::get('users/{role}/permission', [AdminUserController::class, 'getPermissionAndSupervisor'])->middleware('permission:create.user');

        // Routes for site settings
        Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings')->middleware('permission:view.site.settings');
        Route::post('site-settings', [SiteSettingController::class, 'store']);

        //terms and condition
        Route::get('terms-and-condition', [TermsAndConditionController::class, 'index'])->name('termsAndCondition');
        Route::post('terms-and-condition', [TermsAndConditionController::class, 'store']);

        Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacyPolicy');
        Route::post('privacy-policy', [PrivacyPolicyController::class, 'store']);

        // Routes for Seo Setting
        Route::get('seo-setting', [SeoSettingController::class, 'index'])->name('seoSetting')->middleware('permission:view.seoSetting');
        Route::post('seo-setting', [SeoSettingController::class, 'store'])->name('storeSeoSetting')->middleware('permission:create.seoSetting');
        Route::post('fetch-seo-setting', [SeoSettingController::class, 'fetchSeoSetting'])->middleware('permission:view.seoSetting');
        Route::get('seo-setting/{id}/edit', [SeoSettingController::class, 'edit'])->middleware('permission:edit.seoSetting');
        Route::post('seo-setting/{id}', [SeoSettingController::class, 'update'])->middleware('permission:edit.seoSetting');
        Route::delete('seo-setting/{id}', [SeoSettingController::class, 'destroy'])->middleware('permission:delete.seoSetting');


        //Route for homepagesettings

        Route::get('homepage-settings',[HomepageController::class,'index'])->name('homepage');

        //newsletter section
        Route::get('newsletter-settings',[NewsletterController::class,'index'])->name('newsletter');

        //Teams section
        Route::get('team-settings',[TeamController::class,'index'])->name('teams');
        Route::post('add-team',[TeamController::class,'store'])->name('add-team');
        Route::post('fetch-teams',[TeamController::class,'fetchTeamList']);
        Route::get('/team/{id}/edit',[TeamController::class,'edit']);
        Route::post('/team/{id}',[TeamController::class,'update']);
        Route::delete('/teams/{id}',[TeamController::class,'destroy']);
        
        
        //category section
        Route::get('category',[CategoryController::class,'index'])->name('category');
        Route::post('fetch-categories',[CategoryController::class,'fetchCategoryList']);
        Route::post('add-category',[CategoryController::class,'store']);
        Route::get('/category/{id}/edit',[CategoryController::class,'edit']);
        Route::post('/category/{id}',[CategoryController::class,'update']);
        Route::delete('/categories/{id}',[CategoryController::class,'destroy']);
        

        //Services Section

        Route::get('service-feature',[ServiceFeaturesController::class,'index'])->name('serviceFeatures');
        Route::post('fetch-service-features',[ServiceFeaturesController::class,'fetchServiceFeatureList']);
        Route::post('add-service-feature',[ServiceFeaturesController::class,'store']);
        Route::get('/service-feature/{id}/edit',[ServiceFeaturesController::class,'edit']);
        Route::post('/service-feature/{id}',[ServiceFeaturesController::class,'update']);
        Route::delete('/service-features/{id}',[ServiceFeaturesController::class,'destroy']);


        //Services Section

        Route::get('service',[ServiceController::class,'index'])->name('services');
        Route::post('fetch-services',[ServiceController::class,'fetchServiceList']);
        Route::post('add-service',[ServiceController::class,'store']);
        Route::get('/service/{id}/edit',[ServiceController::class,'edit']);
        Route::post('/service/{id}',[ServiceController::class,'update']);
        Route::delete('/services/{id}',[ServiceController::class,'destroy']);




    });
});





