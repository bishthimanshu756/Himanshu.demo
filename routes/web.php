<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
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
    
    Route::controller(UserController::class)->group( function() {
        //listing of user
        Route::get('/users', 'index')->name('users.index');
        
        //adding new user
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users/create', 'store')->name('users.store');
        
        //edit and update the details
        Route::get('users/{user}/edit', 'edit')->name('users.edit');
        Route::post('users/{user}/update', 'update')->name('users.update');
        
        //delete the user
        Route::get('users/{user}/delete', 'delete')->name('users.delete');
        
    });
    
        //User status change
    Route::get('users/{user}/status', [UserStatusController::class , 'update'])->name('users.status');

        //User Password Reset
    Route::controller(PasswordResetController::class)->group(function(){
        Route::get('users/{user}/reset-password', 'showResetForm')->name('users.reset-password');
        Route::post('users/{user}/reset-password', 'resetPassword')->name('users.reset-password');
    });

    Route::controller(CategoryController::class)->group(function() {
        
        Route::get('/categories', 'index')->name('categories.index');

        // adding new Category
        Route::get('categories/create', 'create')->name('categories.create');
        Route::post('categories/store', 'store')->name('categories.store');

        Route::get('categories/{category}/edit', 'edit')->name('categories.edit');
        Route::post('categories/{category}/update', 'update')->name('categories.update');

        //deleting category
        Route::get('categories/{category}/delete', 'delete')->name('categories.delete');
    });

    Route::get('categories/{category}/status', [CategoryStatusController::class, 'update'])->name('categories.status');
});

        //User Password Set
Route::middleware('guest')->group(function() {
    Route::controller(WelcomeController::class)->group(function() {
        Route::get('users/{user}/set-password', 'showWelcomeForm')->name('users.set-password');
        Route::post('users/{user}/set-password', 'setPassword')->name('users.set-password');
    });
});
