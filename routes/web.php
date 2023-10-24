<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'students',
    'as' => 'students.',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/create', [StudentController::class, 'store'])->name('store');
});

Route::group([
    'prefix' => 'quizzes',
    'as' => 'quizzes.',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('/create', [QuizController::class, 'create'])->name('create');
    Route::post('/create', [QuizController::class, 'store'])->name('store');
    Route::get('/{id}', [QuizController::class, 'detail'])->name('detail');
    Route::get('/{id}/create', [QuizController::class, 'detailCreate'])->name('detail.create');
    Route::post('/{id}/create', [QuizController::class, 'detailStore'])->name('detail.store');
    Route::get('/{id}/scores', [QuizController::class, 'detailScore'])->name('detail.score');
});

Route::group([
    'prefix' => 'my-quizzes',
    'as' => 'my-quizzes.',
    'middleware' => ['auth', 'student']
], function () {
    Route::get('/', [QuizController::class, 'myQuizzes'])->name('index');
    Route::get('/{id}', [QuizController::class, 'myDetailQuiz'])->name('detail');
    Route::post('/{id}', [QuizController::class, 'myDetailQuizStore'])->name('store');
    Route::post('/{id}/done', [QuizController::class, 'myDetailQuizDone'])->name('done');
    Route::get('/{id}/score', [QuizController::class, 'myDetailQuizScore'])->name('score');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/material', function () {
    return view('material');
})->middleware(['auth'])->name('material');

Route::get('/my-profile', function () {
    return view('my-profile');
})->middleware(['auth', 'student'])->name('my-profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
