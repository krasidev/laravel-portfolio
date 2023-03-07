<?php

use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\UserController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'panel',
    'as' => 'panel.',
    'middleware' => ['auth']
], function() {
    //Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    //Users
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');

});
