@extends('layout.template')

@section('title', 'Homepage')

@section('content')
<h1>Popular Movie</h1>

<div class="mb-3">
    <form action="/" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="search"
                   placeholder="Cari judul atau sinopsis..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
</div>

<div class="row">
    @forelse ($movies as $movie)
        @include('partials.movie-card', ['movie' => $movie])
    @empty
        <p class="text-muted">Tidak ada film ditemukan.</p>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $movies->links() }}
</div>
@endsection
