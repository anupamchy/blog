<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store']);

Route::get('/students/login', function () {
    return view('students.login');
});
Route::post('/students/login', [StudentController::class, 'authenticate']);

Route::middleware(['auth:student'])->group(function () {
    Route::get('/blogs/create', [BlogController::class, 'create']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/students/dashboard', function () {
        return view('students.dashboard');
    });
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->middleware('auth:student');
    Route::post('/comments/{comment}/replies', [CommentController::class, 'replyStore'])->middleware('auth:student');
});
Route::post('/students/logout', [StudentController::class, 'logout'])->middleware('auth:student');
