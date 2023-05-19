<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\DiscussionReplyController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VirtualClassroomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'index')->middleware('guest');

require __DIR__.'/auth.php';

Route::middleware('userAuth')->group(function (){
    Route::view('/home', 'home');

    Route::resource('users', UserController::class)->middleware(['role:Admin,admin']);

    Route::resource('courses', CourseController::class);

    Route::get('videos/{course}/{video?}', [VideoController::class, 'index'])->name('videos.index');
    Route::resource('videos', VideoController::class)->except('index');

    Route::resource('trainings', TrainingController::class);

    Route::controller(LetterController::class)->group(function (){
        Route::post('letters', 'store')->name('letters.store');
        Route::DELETE('letters', 'destroy')->name('letters.destroy');
        Route::PUT('letters/accept', 'acceptRequest')->name('letters.accept');
        Route::PUT('letters/refuse', 'refuseRequest')->name('letters.refuse');
    });

    Route::resource('discussions', DiscussionController::class);

    Route::resource('discussion-replies', DiscussionReplyController::class);

    Route::resource('classrooms', VirtualClassroomController::class);

    Route::resource('articles', ArticleController::class);
});
