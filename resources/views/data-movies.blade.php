@extends('layout.template')

@section('title', 'Data Movie')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Data Movie</h1>
    <a href="/movies/create" class="btn btn-primary">+ Tambah Movie</a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tahun</th>
            <th>Pemain</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($movies as $movie)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $movie->judul }}</td>
            <td>{{ $movie->category->nama_kategori }}</td>
            <td>{{ $movie->tahun }}</td>
            <td>{{ $movie->pemain }}</td>
            <td class="text-nowrap">
                <a href="/movies/edit/{{ $movie->id }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('movies.delete', ['id' => $movie->id]) }}"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data film.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $movies->links() }}
</div>
@endsection
