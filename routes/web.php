<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(QuestionController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/questions/create', 'create')->name('question_create')->middleware(['auth']);
    Route::get('/questions/{question}', 'show')->name('question_show');
    Route::post('/questions', 'store')->name('question_store')->middleware(['auth']);
    Route::get('/questions/{question}/edit','edit')->name('question_edit')->middleware(['auth']);
    Route::put('/questions/{question}', 'update')->name('question_update')->middleware(['auth']);
    Route::delete('/questions/{question}', 'delete')->name('question_delete')->middleware(['auth']);
});

Route::controller(AnswerController::class)->middleware(['auth'])->group(function(){
    Route::get('/questions/{question}/answers/create', 'create')->name('answer_create');
    Route::post('/answers', 'store')->name('answer_store');
    Route::get('/questions/{question}/answers/{answer}/edit','edit')->name('answer_edit');
    Route::put('/questions/{question}/answers/{answer}', 'update')->name('answer_update');
    Route::delete('questions/{question}/answers/{answer}', 'delete')->name('answer_delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
