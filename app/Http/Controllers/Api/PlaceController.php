<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Services\PlaceService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class PlaceController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $places = $this->service->list($request->all());
        return $this->success(PlaceResource::collection($places), 'List of places');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:places',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        $place = $this->service->store($data);
        return $this->success(new PlaceResource($place), 'Place created successfully', 201);
    }

    public function show($id)
    {
        $place = $this->service->show($id);
        if (!$place) return $this->error('Local não encontrado', 404);
        return $this->success(new PlaceResource($place), 'Place details');
    }

    public function update(Request $request, $id)
    {


        $data = $request->validate([
            'name' => 'sometimes|string',
            'slug' => 'sometimes|string|unique:places,slug,' . $id . ',id',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
        ]);


        $place = $this->service->update($data, $id);
        return $this->success(new PlaceResource($place), 'Place updated');
    }

    public function destroy($id)
    {
        $deleted = $this->service->delete($id);
        return $this->success(null, $deleted ? 'Place removed' : 'Failed to remove place');
    }
}
