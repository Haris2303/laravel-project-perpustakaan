<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::all();

        $data = [
            'books' => $books
        ];

        return view('web.books', $data);
    }

    public function detail(): View
    {
        return view('web.detail');
    }
}
