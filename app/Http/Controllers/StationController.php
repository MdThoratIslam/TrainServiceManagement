<?php

namespace App\Http\Controllers;

use App\Http\Requests\Station\StoreStationRequest;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Http\Resources\Station\StationResource;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = Station::all();
        return StationResource::collection($stations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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


    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStationRequest $request, Station $station)
    {
        $validatedData = $request->validated();
        $station->update($validatedData);
        return new StationResource($station);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $station = Station::findOrFail($id);
            $station->delete();
            return response()->json([
                'message'       => 'Station deleted successfully.',
                'data'          => new StationResource($station)
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
