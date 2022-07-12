<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTeamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LearnableController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TeamCourseController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserEnrollmentController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\UserTeamController;
use App\Http\Controllers\WelcomeController;
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
    // if (Auth::check()) {
    //     if (Auth::user()->is_employee) {
    //         return redirect()->route('my-courses');
    //     }
    // }
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');


    /**User Routes */
    Route::controller(UserController::class)->group( function() {
        Route::get('/users', 'index')->name('users.index');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users/store', 'store')->name('users.store');
        Route::get('users/{user:slug}/edit', 'edit')->name('users.edit');
        Route::post('users/{user:slug}/update', 'update')->name('users.update');
        Route::get('users/{user:slug}/delete', 'delete')->name('users.delete');
    });

    /** 1 User/Trainer enrolled to multiple Courses */
    Route::controller(UserEnrollmentController::class)->group(function() {
        Route::get('users/{user:slug}/courses', 'index')->name('users.courses.index');
        Route::post('users/{user}/courses/store','store')->name('users.courses.store');
        Route::post('users/{user}/courses/delete', 'delete')->name('users.courses.delete');
    });

    /**1 Trainer assigned to multiple Courses */
    Route::controller(TeamCourseController::class)->group(function() {
        Route::get('teams/{trainer:slug}/courses', 'index')->name('teams.courses.index');
        Route::post('teams/{trainer}/courses/store', 'store')->name('teams.courses.store');
        Route::post('teams/{trainer}/courses/delete', 'delete')->name('teams.courses.delete');
    });

    /** Changing the status of a User */
    Route::get('users/{user:slug}/status', [UserStatusController::class , 'update'])->name('users.status');

    /** Password Reset Routes */
    Route::controller(PasswordResetController::class)->group(function(){
        Route::get('users/{user:slug}/reset-password', 'showResetForm')->name('users.reset-password');
        Route::post('users/{user}/reset-password', 'resetPassword')->name('users.reset-password');
    });


    /** Category Routes */
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('categories/create', 'create')->name('categories.create');
        Route::post('categories/store', 'store')->name('categories.store');
        Route::get('categories/{category:slug}/edit', 'edit')->name('categories.edit');
        Route::post('categories/{category:slug}/update', 'update')->name('categories.update');
        Route::get('categories/{category:slug}/delete', 'delete')->name('categories.delete');
    });

    /** Changing the status of a Category */
    Route::get('categories/{category:slug}/status', [CategoryStatusController::class, 'update'])->name('categories.status');

    /**1 Trainer assign multiple Employees Routes */
    Route::controller(TeamUserController::class)->group(function() {
        Route::get('teams/{trainer:slug}/users', 'index')->name('teams.users.index');
        Route::post('teams/{trainer}/users/store', 'store')->name('teams.users.store');
        Route::post('teams/{trainer:slug}/users/destroy', 'destroy')->name('teams.users.destroy');
    });

    /** 1 Employee assign multiple Trainer Routes */
    Route::controller(UserTeamController::class)->group(function() {
        Route::get('users/{user:slug}/teams', 'index')->name('users.teams.index');
        Route::post('users/{user}/store', 'store')->name('users.teams.store');
        Route::post('users/{user:slug}/teams', 'destroy')->name('users.team.destroy');
    });


    /** Courses Routes */
    Route::controller(CourseController::class)->group(function() {
        Route::get('/courses', 'index')->name('courses.index');
        Route::get('courses/create', 'create')->name('courses.create');
        Route::post('courses/store', 'store')->name('courses.store');
        Route::get('courses/{course:slug}/edit', 'edit')->name('courses.edit');
        Route::post('courses/{course:slug}/update', 'update')->name('courses.update');
        Route::get('courses/{course:slug}/delete', 'delete')->name('courses.delete');
        Route::get('courses/{course:slug}/show', 'show')->name('courses.show');
    });

    /** 1 Course assign to multiple Trainers */
    Route::controller(CourseTeamController::class)->group(function() {
        Route::get('courses/{course:slug}/teams', 'index')->name('courses.teams.index');
        Route::post('courses/{course}/teams', 'store')->name('courses.teams.store');
        Route::post('courses/{course:slug}', 'delete')->name('courses.teams.delete');
    });

    /** 1 Course enrolled to multiple Users/Trainers */
    Route::controller(EnrollmentController::class)->group(function() {
        Route::get('courses/{course:slug}/users', 'index')->name('courses.users.index');
        Route::post('courses/{course}/store', 'store')->name('courses.users.store');
        Route::post('courses/{course}/users', 'delete')->name('courses.users.delete');
    });

    /** Unit Controller */
    Route::controller(UnitController::class)->group(function() {
        Route::get('courses/{course:slug}/units/create', 'create')->name('courses.units.create');
        Route::post('courses/{course}/units/store', 'store')->name('courses.units.store');
        Route::get('courses/{course:slug}/units/{unit:slug}/edit', 'edit')->name('courses.units.edit');
        Route::post('courses/{course}/units/{unit}/update', 'update')->name('courses.units.update');
        Route::get('courses/{course:slug}/units/{unit:slug}/delete', 'delete')->name('courses.units.delete');
    });

    /** Test Controller */
    Route::controller(TestController::class)->group(function() {
        Route::get('courses/{course:slug}/units/{unit}/tests/create', 'create')->name('courses.units.tests.create');
        Route::post('courses/{course}/units/{unit}/tests/store', 'store')->name('courses.units.tests.store');
        Route::get('courses/{course:slug}/tests/{test}/edit', 'edit')->name('courses.tests.edit');
        Route::post('courses/{course:slug}/tests/{test}/update', 'update')->name('courses.tests.update');
    });

    /**Lesson Controller for lesson delete */
    Route::get('courses/{course:slug}/lessons/{lesson}/delete', [LessonController::class, 'delete'])->name('courses.lessons.delete');

    Route::controller(QuestionController::class)->group(function() {
        Route::get('courses/{course:slug}/tests/{test}/questions/create', 'create')
            ->name('courses.tests.questions.create');
        Route::post('courses/{course:slug}/tests/{test}/questions/store', 'store')
            ->name('courses.tests.questions.store');
        Route::get('courses/{course:slug}/tests/{test}/questions/{question}/edit', 'edit')
            ->name('courses.tests.questions.edit');
        Route::post('courses/{course:slug}/tests/{test}/questions/{question}/update', 'update')
            ->name('courses.tests.questions.update');
        Route::get('courses/{course:slug}/tests/{test}/questions/{question}/delete', 'delete')
            ->name('courses.tests.questions.delete');
    });

    Route::controller(LearnableController::class)->group(function() {
        Route::get('/mycourses', 'index')->name('my-courses');
    });

});

    /** Set Password */
Route::middleware('guest')->group(function() {

    Route::controller(WelcomeController::class)->group(function() {
        Route::get('users/{user:slug}/set-password', 'showWelcomeForm')->name('users.set-password');
        Route::post('users/{user:slug}/set-password', 'setPassword')->name('users.set-password');
    });
});