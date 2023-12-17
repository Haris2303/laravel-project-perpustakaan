<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(): View
    {
        $genres = Genre::all();
        $data = [
            'title' => 'Kelola Genre',
            'genres' => $genres
        ];

        return view('dashboard.genre.index', $data);
    }

    public function create(): View
    {
        $data = [
            'title' => 'Tambah Genre'
        ];

        return view('dashboard.genre.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $credential = $request->validate([
            'name' => ['required', 'string', 'unique:genres'],
            'description' => ['string']
        ]);

        Genre::create($credential);

        return redirect('/dashboard/genres')->with('success', 'Data Genre berhasil ditambahkan!');
    }

    public function edit($id): View
    {
        $genre = Genre::where('id', $id)->firstOrFail();
        $data = [
            'title' => 'Edit Genre',
            'genre' => $genre
        ];

        return view('dashboard.genre.edit', $data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ];

        $genre = Genre::where('id', $id)->firstOrFail();

        if ($genre->name !== $request->name) {
            $rules['name'] = ['required', 'string', 'unique:genres'];
        }

        $credential = $request->validate($rules);

        Genre::where('id', $id)->update($credential);

        return redirect('dashboard/genres')->with('success', 'Data Genre berhasil diedit!');
    }

    public function delete($id): RedirectResponse
    {
        Genre::where('id', $id)->delete();

        return redirect('/dashboard/genres')->with('success', 'Data Genre berhasil dihapus!');
    }
}
