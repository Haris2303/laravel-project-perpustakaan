<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Returned;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReturnedController extends Controller
{
    public function index(): View
    {
        $returneds = Returned::all();
        $data = [
            'title' => 'Kelola Pengembalian',
            'returneds' => $returneds
        ];

        return view('dashboard.returned.index', $data);
    }

    public function create(): View
    {
        $borrowings = Borrowing::all();
        $data = [
            'title' => 'Tambah Pengembalian',
            'borrowings' => $borrowings
        ];

        return view('dashboard.returned.create', $data);
    }
}
