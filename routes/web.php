<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\WelcomeController;
use App\Models\Role;
use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return view('welcome');
});



require __DIR__.'/auth.php';


Route::middleware('auth')->group( function() {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    //User Routes
    Route::controller(UserController::class)->group( function() {
        Route::get('/users', 'index')->name('users.index');
        
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users/store', 'store')->name('users.store');
        
        Route::get('users/{user:slug}/edit', 'edit')->name('users.edit');
        Route::post('users/{user:slug}/update', 'update')->name('users.update');
        
        Route::get('users/{user:slug}/delete', 'delete')->name('users.delete');       
    });
    
    Route::get('users/{user:slug}/status', [UserStatusController::class , 'update'])->name('users.status');

    Route::controller(PasswordResetController::class)->group(function(){
        Route::get('users/{user:slug}/reset-password', 'showResetForm')->name('users.reset-password');
        Route::post('users/{user:slug}/reset-password', 'resetPassword')->name('users.reset-password');
    });


    //Category Routes
    Route::controller(CategoryController::class)->group(function() {
        
        Route::get('/categories', 'index')->name('categories.index');

        Route::get('categories/create', 'create')->name('categories.create');
        Route::post('categories/store', 'store')->name('categories.store');

        Route::get('categories/{category:slug}/edit', 'edit')->name('categories.edit');
        Route::post('categories/{category:slug}/update', 'update')->name('categories.update');

        Route::get('categories/{category:slug}/delete', 'delete')->name('categories.delete');
    });

    Route::get('categories/{category:slug}/status', [CategoryStatusController::class, 'update'])->name('categories.status');

    //Trainer Routes
    Route::controller(TeamUserController::class)->group(function() {
        Route::get('teams/{user:slug}/users', 'index')->name('teams.index');
        Route::post('teams/{user:slug}/users', 'store')->name('teams.assign');
        Route::post('teams/{user:slug}/users', 'destroy')->name('teams.unassign');
    });
});

        //User Password Set
Route::middleware('guest')->group(function() {
    Route::controller(WelcomeController::class)->group(function() {
        Route::get('users/{user:slug}/set-password', 'showWelcomeForm')->name('users.set-password');
        Route::post('users/{user:slug}/set-password', 'setPassword')->name('users.set-password');
    });
});
