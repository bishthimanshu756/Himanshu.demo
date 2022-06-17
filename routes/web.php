<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use App\Models\User;
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
        Route::post('users/create', 'store')->name('users.create');
        
        //edit and update the details
        Route::get('users/{user}/edit', 'edit')->name('users.update');
        Route::post('users/{user}/edit', 'update')->name('users.update');
        
        //delete the user
        Route::get('users/{user}/delete', 'delete')->name('users.delete');
        
    });
    
        //User status change
        Route::get('users/{user}/status', [UserStatusController::class , 'update'])->name('users.status');
    
});

