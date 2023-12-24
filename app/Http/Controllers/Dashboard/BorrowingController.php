<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(): View
    {
        $borrowings = Borrowing::all();
        $data = [
            'title' => 'Kelola Peminjaman',
            'borrowings' => $borrowings
        ];

        return view('dashboard.borrowing.index', $data);
    }

    public function create(): View
    {
        $members = Member::all();
        $books = Book::all();

        $data = [
            'title' => 'Tambah Peminjaman',
            'books' => $books,
            'members' => $members
        ];

        return view('dashboard.borrowing.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $credential = $request->validate([
            'lateness' => ['required'],
            'loan_date' => ['required', 'date'],
            'return_date' => ['required', 'date'],
            'book_id' => ['required'],
            'member_id' => ['required']
        ]);

        Borrowing::create($credential);

        return redirect('/dashboard/borrowings')->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    public function edit($id): View
    {
        $borrowing = Borrowing::where('id', $id)->firstOrFail();
        $books = Book::all();
        $members = Member::all();

        $data = [
            'title' => 'Edit Data Peminjaman',
            'borrowing' => $borrowing,
            'books' => $books,
            'members' => $members
        ];

        return view('dashboard.borrowing.edit', $data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'lateness' => ['required'],
            'loan_date' => ['required', 'date'],
            'return_date' => ['required', 'date'],
            'book_id' => ['required'],
            'member_id' => ['required']
        ]);

        $borrowing = Borrowing::find($id);
        $borrowing->lateness = $request->lateness;
        $borrowing->loan_date = $request->loan_date;
        $borrowing->return_date = $request->return_date;
        $borrowing->book_id = $request->book_id;
        $borrowing->member_id = $request->member_id;
        $borrowing->save();

        return redirect('/dashboard/borrowings')->with('success', 'Data peminjaman berhasil diubah!');
    }

    public function delete(Request $request): RedirectResponse
    {
        Borrowing::where('id', $request->id)->delete();

        return redirect('/dashboard/borrowings')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
