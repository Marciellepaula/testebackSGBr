<?php

namespace Tests\Unit;

use App\Models\Place;
use App\Repositories\PlaceRepository;
use App\Services\PlaceService;
use Mockery;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class PlaceServiceTest extends TestCase
{
    protected $mockRepo;
    protected PlaceService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockRepo = Mockery::mock(PlaceRepository::class);
        $this->service = new PlaceService($this->mockRepo);
    }

    public function test_it_lists_places(): void
    {
        $places = collect(['Place 1', 'Place 2']);

        $this->mockRepo
            ->shouldReceive('all')
            ->with([])
            ->once()
            ->andReturn($places);

        $result = $this->service->list();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(2, $result);
    }

    public function test_it_stores_a_place(): void
    {
        $data = ['name' => 'Test', 'city' => 'City', 'state' => 'State'];
        $place = new Place($data);

        $this->mockRepo
            ->shouldReceive('create')
            ->with($data)
            ->once()
            ->andReturn($place);

        $result = $this->service->store($data);

        $this->assertInstanceOf(Place::class, $result);
        $this->assertEquals('Test', $result->name);
    }

    public function test_it_updates_a_place(): void
    {
        $data = ['name' => 'Updated'];
        $updatedPlace = new Place($data);

        $this->mockRepo
            ->shouldReceive('update')
            ->with($data, 1)
            ->once()
            ->andReturn($updatedPlace);

        $result = $this->service->update($data, 1);

        $this->assertEquals('Updated', $result->name);
    }

    public function test_it_deletes_a_place(): void
    {
        $this->mockRepo
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn(true);

        $result = $this->service->delete(1);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
