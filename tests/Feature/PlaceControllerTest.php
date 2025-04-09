<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_places()
    {
        Place::factory()->count(3)->create();

        $response = $this->getJson('/api/places');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => ['id', 'name', 'slug', 'city', 'state', 'created_at',]
                ]
            ]);
    }

    public function test_can_create_place()
    {
        $data = [
            'name' => 'Test Place',
            'slug' => 'test-place',
            'city' => 'Test City',
            'state' => 'TS'
        ];

        $response = $this->postJson('/api/places', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test Place']);
        $this->assertDatabaseHas('places', ['slug' => 'test-place']);
    }

    public function test_can_show_a_place()
    {
        $place = Place::factory()->create();

        $response = $this->getJson("/api/places/{$place->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $place->id]);
    }

    public function test_can_update_a_place()
    {
        $place = Place::factory()->create();

        $response = $this->putJson("/api/places/{$place->id}", [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);
        $this->assertDatabaseHas('places', ['id' => $place->id, 'name' => 'Updated Name']);
    }

    public function test_can_delete_a_place()
    {
        $place = Place::factory()->create();

        $response = $this->deleteJson("/api/places/{$place->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Place removed']);
        $this->assertDatabaseMissing('places', ['id' => $place->id]);
    }
}
