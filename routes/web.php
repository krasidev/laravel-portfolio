<?php

use App\Http\Controllers\Panel\GoogleAnalyticsController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\ProjectController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\ProjectController as ControllersProjectController;
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

Auth::routes([
    'reset' => false
]);

Route::get('/', [ControllersProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ControllersProjectController::class, 'show'])->name('projects.show');

Route::group([
    'prefix' => 'panel',
    'as' => 'panel.',
    'middleware' => ['auth']
], function() {
    //Google Analytics
    Route::controller(GoogleAnalyticsController::class)->group(function() {
        Route::get('google-analytics/urls', 'urls')->name('google-analytics.urls');
        Route::get('google-analytics/locations', 'locations')->name('google-analytics.locations');
        Route::get('google-analytics/languages', 'languages')->name('google-analytics.languages');
        Route::get('google-analytics/browsers', 'browsers')->name('google-analytics.browsers');
        Route::get('google-analytics/device-categories', 'deviceCategories')->name('google-analytics.device-categories');
        Route::get('google-analytics/operating-systems', 'operatingSystems')->name('google-analytics.operating-systems');

        Route::middleware('can:manage_system')->group(function() {
            Route::get('google-analytics/sync/urls', 'syncUrls')->name('google-analytics.sync.urls');
            Route::get('google-analytics/sync/locations', 'syncLocations')->name('google-analytics.sync.locations');
            Route::get('google-analytics/sync/languages', 'syncLanguages')->name('google-analytics.sync.languages');
            Route::get('google-analytics/sync/browsers', 'syncBrowsers')->name('google-analytics.sync.browsers');
            Route::get('google-analytics/sync/device-categories', 'syncDeviceCategories')->name('google-analytics.sync.device-categories');
            Route::get('google-analytics/sync/operating-systems', 'syncOperatingSystems')->name('google-analytics.sync.operating-systems');
        });
    });

    //Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::middleware('can:manage_system')->group(function() {
        //Projects
        Route::resource('projects', ProjectController::class)->except('show');
        Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('projects/{project}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
        Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');

        //Users
        Route::resource('users', UserController::class)->except('show');
        Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    });
});
