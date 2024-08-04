<?php

namespace App\Http\Controllers\Api\Train;

use App\Http\Controllers\Controller;
use App\Http\Requests\Train\StoreTrainRequest;
use App\Http\Requests\Train\UpdateTrainRequest;
use App\Http\Resources\Api\Train\TrainResource;
use App\Models\Api\Train\Train;
use Illuminate\Support\Facades\DB;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $train = Train::with('stops')->get();
        return TrainResource::collection($train);
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
    public function store(StoreTrainRequest $request)
    {
        try {
            //dd($request->stops);
            DB::beginTransaction();
            $train = Train::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            foreach ($request->stops as $stopData)
            {
                $train->stops()->create([
                    'train_id'          => $train->id,
                    'station_id'        => $stopData['station_id'],
                    'arrival_time'      => $stopData['arrival_time'],
                    'departure_time'    => $stopData['departure_time'],
                ]);
            }
            DB::commit();
            return new TrainResource($train->load('stops'));
        }catch (\Exception $e)
        {
            DB::rollBack();
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
    public function show(Train $train)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Train $train)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainRequest $request, Train $train)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Train $train)
    {
        //
    }
}
