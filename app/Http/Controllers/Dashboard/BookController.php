<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'isbn' => ['required', 'numeric', 'unique:books'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'publication_year' => ['required', 'size:4'],
            'quantity' => ['required', 'numeric'],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
            'shell_code' => ['required', 'max:4'],
            'cover' => ['image', 'file', 'max:1024']
        ]);

        DB::transaction(function () use ($credential, $request) {
            $credential['admin_id'] = Auth::user()->id;

            if ($request->file('cover')) {
                $credential['cover'] = $request->file('cover')->store('cover-images');
            }

            Book::create($credential);

            $book = Book::where('isbn', $request->isbn)->first();

            // attach genres
            if (!is_null($request->genres)) {
                foreach ($request->genres as $genre) {
                    $book->hasGenres()->attach($genre);
                }
            }
        });

        return redirect('/dashboard/books')->with('success', 'Data Buku berhasil ditambahkan!');
    }

    public function edit($isbn): View
    {
        $book = Book::where('isbn', $isbn)->firstOrFail();
        $genres = Genre::all();
        $data = [
            'title' => 'Ubah Data Buku',
            'book' => $book,
            'genres' => $genres
        ];

        return view('dashboard.book.edit', $data);
    }

    public function update(Request $request, $isbn): RedirectResponse
    {
        $book = Book::where('isbn', $isbn)->firstOrFail();

        $rules = [
            'isbn' => ['required', 'numeric'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'publication_year' => ['required', 'size:4'],
            'quantity' => ['required', 'numeric'],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
            'shell_code' => ['required', 'max:4'],
            'cover' => ['file', 'image']
        ];

        if ($book->isbn !== $request->isbn) {
            $rules['isbn'] = ['required', 'numeric', 'unique:books'];
        }

        $credential = $request->validate($rules);

        // check image
        if ($request->file('image')) {
            // if image is changed
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $credential['cover'] = $request->file('cover')->store('cover-images');
        }

        Book::where('isbn', $isbn)->update($credential);

        return redirect('/dashboard/books')->with('success', 'Data Buku berhasil diubah!');
    }

    public function delete($isbn): RedirectResponse
    {
        $book = Book::where('isbn', $isbn)->firstOrFail();

        // detach
        foreach ($book->hasGenres as $genre) {
            $book->hasGenres()->detach($genre->id);
        }

        // delete
        $book->delete();

        return redirect('/dashboard/books')->with('success', 'Data Buku berhasil dihapus!');
    }
}
