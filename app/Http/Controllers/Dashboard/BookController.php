<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::all();

        $data = [
            'title' => 'Kelola Buku',
            'books' => $books
        ];

        return view('dashboard.book.index', $data);
    }

    public function create(): View
    {
        $genres = Genre::all();
        $data = [
            'title' => 'Tambah Buku',
            'genres' => $genres
        ];

        return view('dashboard.book.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $credential = $request->validate([
            'isbn' => ['required', 'numeric', 'max:16', 'unique:books'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'publication_year' => ['required', 'max:4'],
            'quantity' => ['required', 'numeric'],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
            'shell_code' => ['required', 'max:4']
        ]);

        DB::transaction(function () use ($credential, $request) {
            Book::create($credential);

            $book = Book::where('isbn', $request->isbn)->first();

            $book->hasGenres()->attach($request->genre);
        });

        return redirect('/dashboard/books')->with('success', 'Data Buku berhasil ditambahkan!');
    }
}
