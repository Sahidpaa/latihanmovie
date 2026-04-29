@extends('layout.template')

@section('title', 'Edit Movie')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Movie</h2>
    <a href="/movies/data" class="btn btn-secondary">← List Movie</a>
</div>

<form action="{{ route('movies.update', ['id' => $movie->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.movie-form', ['movie' => $movie, 'categories' => $categories])
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
@endsection
