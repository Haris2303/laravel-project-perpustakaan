<?php

use App\Http\Controllers\ProfileController;
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
    return redirect('/login');
});

// Member Access
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\BookController::class, 'index']);
    Route::get('/book/detail', [\App\Http\Controllers\BookController::class, 'detail']);
});

// Admin Access
Route::middleware(['auth', 'verified', \App\Http\Middleware\IsAdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Members
    Route::get('/dashboard/members', [\App\Http\Controllers\Dashboard\MemberController::class, 'index']);
    Route::post('/dashboard/members', [\App\Http\Controllers\Dashboard\MemberController::class, 'store']);
    Route::get('/dashboard/members/create', [\App\Http\Controllers\Dashboard\MemberController::class, 'create']);
    Route::get(
        '/dashboard/member/edit/{member_code}',
        [\App\Http\Controllers\Dashboard\MemberController::class, 'edit']
    );
    Route::put(
        '/dashboard/member/{member_code}',
        [\App\Http\Controllers\Dashboard\MemberController::class, 'update']
    );
    Route::delete(
        '/dashboard/member/{member_code}',
        [\App\Http\Controllers\Dashboard\MemberController::class, 'delete']
    );

    // Genres
    Route::get('/dashboard/genres', [\App\Http\Controllers\Dashboard\GenreController::class, 'index']);
    Route::get('/dashboard/genre/create', [\App\Http\Controllers\Dashboard\GenreController::class, 'create']);
    Route::post('/dashboard/genres', [\App\Http\Controllers\Dashboard\GenreController::class, 'store']);
    Route::get('/dashboard/genre/{id}', [\App\Http\Controllers\Dashboard\GenreController::class, 'edit']);
    Route::put('/dashboard/genre/{id}', [\App\Http\Controllers\Dashboard\GenreController::class, 'update']);
    Route::delete('/dashboard/genre/{id}', [\App\Http\Controllers\Dashboard\GenreController::class, 'delete']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
