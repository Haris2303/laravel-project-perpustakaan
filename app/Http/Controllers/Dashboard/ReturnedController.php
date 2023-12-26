<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Returned;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $borrowings = Borrowing::where('is_return', false)->get();
        $data = [
            'title' => 'Tambah Pengembalian',
            'borrowings' => $borrowings
        ];

        return view('dashboard.returned.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $credential = $request->validate([
            'time_returned' => 'required',
            'return_date' => ['required', 'date'],
            'borrowing_id' => ['required', 'numeric']
        ]);

        $borrowing = Borrowing::where('id', $request->borrowing_id)->firstOrFail();

        // add member id
        $credential['member_id'] = $borrowing->member_id;

        // initial datetime
        $borrowingDate = new DateTime("$borrowing->return_date $borrowing->lateness");
        $returnedDate = new DateTime("$request->return_date $request->time_returned");

        // convert string datetime ke int
        $borrowingDate = $borrowingDate->getTimestamp();
        $returnedDate = $returnedDate->getTimestamp();

        // menghitung denda pengembalian
        $result = $returnedDate - $borrowingDate;
        if ($result > 0) {
            $credential['late_payment'] = ($result / 3600) * 5000;
        } else {
            $credential['late_payment'] = 0;
        }

        // insert data
        Returned::query()->create($credential);

        // get data peminjaman
        $borrowing = Borrowing::where('id', $request->borrowing_id)->firstOrFail();

        // set column is_return menjadi true
        $borrowing->is_return = true;
        $borrowing->update();

        // get data
        $returned = Returned::where('borrowing_id', $request->borrowing_id)->firstOrFail();

        return ($result) ?
            redirect('/dashboard/returneds/payment/' . $returned->id)->with('success', 'Data berhasil ditambahkan!') :
            redirect('/dashboard/returneds')->with('success', 'Data Pengembalian berhasil ditambahkan!');
    }

    public function payment($id): View
    {
        $returned = Returned::where('id', $id)->firstOrFail();
        $data = [
            'title' => 'Pembayaran Denda',
            'returned' => $returned
        ];

        return view('dashboard.returned.payment', $data);
    }

    public function do_pay($id): RedirectResponse
    {
        $returned = Returned::find($id);

        $returned->late_payment = 0;
        $returned->update();

        return redirect('/dashboard/returneds')->with('success', 'Denda telah dibayar!');
    }

    public function destroy($id): RedirectResponse
    {
        $returned = Returned::where('id', $id)->firstOrFail();
        $borrowing_id = $returned->borrowing_id;
        $returned->delete();

        Borrowing::where('id', $borrowing_id)->delete();

        return redirect('/dashboard/returneds')->with('success', 'Data pengembalian berhasil dihapus!');
    }
}
