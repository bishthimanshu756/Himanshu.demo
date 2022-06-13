<?php

use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//listing of user
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users.index');

//edit and update the details
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::post('users/{user}/edit', [UserController::class, 'update'])->middleware('auth')->name('users.update');

//adding new user
Route::get('user/add', [UserController::class, 'add'])->middleware('auth')->name('user.add');
Route::post('user/add', [UserController::class, 'store'])->middleware('auth')->name('user.update');

//delete the user
Route::get('users/{user}/delete', [UserController::class, 'delete'])->middleware('auth')->name('user.delete');