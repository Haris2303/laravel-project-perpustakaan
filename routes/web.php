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

    // Books
    Route::get('/dashboard/books', [\App\Http\Controllers\Dashboard\BookController::class, 'index']);
    Route::get('/dashboard/books/create', [\App\Http\Controllers\Dashboard\BookController::class, 'create']);
    Route::post('/dashboard/books', [\App\Http\Controllers\Dashboard\BookController::class, 'store']);
    Route::get('/dashboard/book/{isbn}', [\App\Http\Controllers\Dashboard\BookController::class, 'edit']);
    Route::put('/dashboard/book/{isbn}', [\App\Http\Controllers\Dashboard\BookController::class, 'update']);
    Route::delete('/dashboard/book/{isbn}', [\App\Http\Controllers\Dashboard\BookController::class, 'delete']);

    // Borrowings
    Route::get('/dashboard/borrowings', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'index']);
    Route::get('/dashboard/borrowings/create', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'create']);
    Route::post('/dashboard/borrowings', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'store']);
    Route::get('/dashboard/borrowing/{id}', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'edit']);
    Route::put('/dashboard/borrowing/{id}', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'update']);
    Route::delete('/dashboard/borrowings', [\App\Http\Controllers\Dashboard\BorrowingController::class, 'delete']);

    // Returned
    Route::get('/dashboard/returneds', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'index']);
    Route::get('/dashboard/returneds/create', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'create']);
    Route::post('/dashboard/returneds', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'store']);
    Route::get('/dashboard/returned/{isbn}', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'edit']);
    Route::put('/dashboard/returned/{isbn}', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'update']);
    Route::delete('/dashboard/returned/{isbn}', [\App\Http\Controllers\Dashboard\ReturnedController::class, 'delete']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
