<?php

namespace App\Http\Controllers\Api\Station;

use App\Http\Controllers\Controller;
use App\Http\Requests\Station\StoreStationRequest;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Http\Resources\Api\Station\StationResource;
use App\Models\Station;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        return \App\Http\Resources\Api\Station\StationResource::collection($stations);
    }
    public function store(StoreStationRequest $request)
    {
        try {
            $station = Station::create(
                [
                    'name'      => $request->name,
                    'code'      => $request->code,
                ]
            );
            return new StationResource($station);
        } catch (\Exception $e) {
            return response()->json(
                [
                'error' => 'Failed to create station',
                 'message' =>$e->getMessage()
            ],
                500);
        }
    }
    public function update(UpdateStationRequest $request, Station $station)
    {
        $validatedData = $request->validated();
        $station->update($validatedData);
        return new StationResource($station);
    }
    public function destroy($id)
    {
        try {
            $station = Station::findOrFail($id);
            $station->delete();
            return response()->json([
                'message'       => 'Station deleted successfully.',
                'data'          => new \App\Http\Resources\Api\Station\StationResource($station)
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'         => 'Station not found',
                'message'       =>$e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error'         => 'Failed to delete station',
                'message'       =>$e->getMessage()
            ], 500);
        }
    }
}
