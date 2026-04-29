@extends('layout.template')

@section('title', 'Tambah Movie')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Movie Baru</h2>
    <a href="/movies/data" class="btn btn-secondary">← List Movie</a>
</div>

<form action="/movies/store" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.movie-form', ['movie' => null, 'categories' => $categories])
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
