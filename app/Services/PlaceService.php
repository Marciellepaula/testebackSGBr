<?php



namespace App\Services;

use App\Repositories\PlaceRepository;

class PlaceService
{
    protected $repository;

    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(array $filters = [])
    {
        return $this->repository->all($filters);
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {

        return $this->repository->create($data);
    }

    public function update(array $data, int $id)
    {

        return $this->repository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
