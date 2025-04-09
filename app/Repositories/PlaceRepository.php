<?php


namespace App\Repositories;

use App\Models\Place;

class PlaceRepository
{
    public function all(array $filters = []): \Illuminate\Support\Collection
    {
        $query = Place::query();

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->get();
    }

    public function find(int $id): ?Place
    {
        return Place::find($id);
    }

    public function create(array $data): Place
    {
        return Place::create($data);
    }

    public function update(array $data, int $id): Place
    {
        $place = Place::findOrFail($id);
        $place->update($data);
        return $place;
    }

    public function delete(int $id): bool
    {
        return Place::destroy($id);
    }
}
