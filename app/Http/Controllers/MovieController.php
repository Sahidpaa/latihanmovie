<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function index()
    {
        $query = Movie::latest();
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('sinopsis', 'like', '%' . $search . '%');
            });
        }
        $movies = $query->paginate(6)->withQueryString();
        return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = Movie::findOrFail($id);
        return view('detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    public function store(StoreMovieRequest $request)
    {
        // Ambil data yang sudah tervalidasi
        $validated = $request->validated();

        // Simpan file foto jika ada
        if ($request->hasFile('foto_sampul')) {
            $validated['foto_sampul'] = $request->file('foto_sampul')->store('movie_covers', 'public');
        }

        // Simpan data ke database
        Movie::create($validated);

        return redirect('/')->with('success', 'Film berhasil ditambahkan.');
    }

    public function data()
    {
        $movies = Movie::latest()->paginate(10);
        return view('data-movies', compact('movies'));
    }

    public function form_edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        return view('form-edit', compact('movie', 'categories'));
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('foto_sampul')) {
            // Hapus foto lama jika ada
            if ($movie->foto_sampul) {
                Storage::disk('public')->delete($movie->foto_sampul);
            }
            // Simpan foto baru dan dapatkan path-nya
            $validated['foto_sampul'] = $request->file('foto_sampul')->store('movie_covers', 'public');
        }

        $movie->update($validated);

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus foto film jika ada
        if ($movie->foto_sampul) {
            Storage::disk('public')->delete($movie->foto_sampul);
        }

        // Hapus record film dari database
        $movie->delete();

        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }
}
