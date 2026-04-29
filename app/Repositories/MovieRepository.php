<?php

namespace App\Repositories;

use App\Interfaces\MovieRepositoryInterface;
use App\Models\Movie;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAllPaginated(int $perPage, ?string $search)
    {
        $query = Movie::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('sinopsis', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function findById(string $id)
    {
        return Movie::findOrFail($id);
    }

    public function create(array $data)
    {
        return Movie::create($data);
    }

    public function update(string $id, array $data)
    {
        $movie = $this->findById($id);
        $movie->update($data);
        return $movie;
    }

    public function delete(string $id)
    {
        $movie = $this->findById($id);
        $movie->delete();
        return $movie;
    }

    public function getAllForTable(int $perPage)
    {
        return Movie::latest()->paginate($perPage);
    }
}
