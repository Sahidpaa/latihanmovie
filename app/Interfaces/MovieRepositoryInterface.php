<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    public function getAllPaginated(int $perPage, ?string $search);
    public function findById(string $id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function getAllForTable(int $perPage);
}
