<?php

namespace App\Services;

use App\Interfaces\MovieRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public function __construct(
        protected MovieRepositoryInterface $movieRepository
    ) {}

    public function getMoviesForHomepage(?string $search)
    {
        return $this->movieRepository->getAllPaginated(6, $search);
    }

    public function getMoviesForTable()
    {
        return $this->movieRepository->getAllForTable(10);
    }

    public function findMovie(string $id)
    {
        return $this->movieRepository->findById($id);
    }

    public function createMovie(array $validatedData, $coverFile = null)
    {
        if ($coverFile) {
            $validatedData['foto_sampul'] = $coverFile->store('movie_covers', 'public');
        }
        return $this->movieRepository->create($validatedData);
    }

    public function updateMovie(string $id, array $validatedData, $newCoverFile = null)
    {
        $movie = $this->movieRepository->findById($id);

        if ($newCoverFile) {
            $this->deleteCoverFile($movie->foto_sampul);
            $validatedData['foto_sampul'] = $newCoverFile->store('movie_covers', 'public');
        }

        return $this->movieRepository->update($id, $validatedData);
    }

    public function deleteMovie(string $id)
    {
        $movie = $this->movieRepository->findById($id);
        $this->deleteCoverFile($movie->foto_sampul);
        return $this->movieRepository->delete($id);
    }

    private function deleteCoverFile(?string $filePath)
    {
        if ($filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
