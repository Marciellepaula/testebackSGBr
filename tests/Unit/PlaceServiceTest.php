<?php

namespace Tests\Unit;

use App\Models\Place;
use App\Repositories\PlaceRepository;
use App\Services\PlaceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class PlaceServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = \Mockery::mock(PlaceRepository::class);
        $this->service = new PlaceService($this->repository);
    }

    public function testList(): void
    {
        $filters = ['search' => 'test'];
        $places = new Collection([new Place()]);

        $this->repository->shouldReceive('all')
            ->with($filters)
            ->once()
            ->andReturn($places);

        $result = $this->service->list($filters);

        $this->assertEquals($places, $result);
    }

    public function testShow(): void
    {
        $id = 1;
        $place = new Place();

        $this->repository->shouldReceive('find')
            ->with($id)
            ->once()
            ->andReturn($place);

        $result = $this->service->show($id);

        $this->assertEquals($place, $result);
    }

    public function testStore(): void
    {
        $data = ['name' => 'Test Place'];
        $place = new Place($data);

        $this->repository->shouldReceive('create')
            ->with($data)
            ->once()
            ->andReturn($place);

        $result = $this->service->store($data);

        $this->assertEquals($place, $result);
    }

    public function testUpdate(): void
    {
        $id = 1;
        $data = ['name' => 'Updated Place'];
        $place = new Place($data);

        $this->repository->shouldReceive('update')
            ->with($data, $id)
            ->once()
            ->andReturn($place);

        $result = $this->service->update($data, $id);

        $this->assertEquals($place, $result);
    }

    public function testDelete(): void
    {
        $id = 1;

        $this->repository->shouldReceive('delete')
            ->with($id)
            ->once()
            ->andReturn(true);

        $result = $this->service->delete($id);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
