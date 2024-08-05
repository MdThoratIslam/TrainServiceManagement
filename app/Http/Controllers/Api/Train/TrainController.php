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
                    'train_id'              => $train->id,
                    'station_id'            => $stopData['station_id'],
                    'arrival_time'          => $stopData['arrival_time'],
                    'departure_time'        => $stopData['departure_time'],
                    'distance_from_start'   => $stopData['distance_from_start'],
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

    public function update(UpdateTrainRequest $request, Train $train)
    {
        try {
            DB::beginTransaction();

            // Update train's basic information
            $train->update($request->only('name', 'code'));

            if ($request->has('stops')) {
                foreach ($request->stops as $stopData) {
                    // Find stop by unique combination of station_id and arrival_time
                    $stop = $train->stops()->where('station_id', $stopData['station_id'])
                        ->where('arrival_time', $stopData['arrival_time'])
                        ->first();

                    if ($stop) {
                        // Update the existing stop
                        $stop->update([
                            'station_id'          => $stopData['station_id'],
                            'arrival_time'        => $stopData['arrival_time'],
                            'departure_time'      => $stopData['departure_time'],
                            'distance_from_start' => $stopData['distance_from_start'],
                        ]);
                    } else {
                        // Create a new stop if no matching stop found
                        $train->stops()->create([
                            'station_id'          => $stopData['station_id'],
                            'arrival_time'        => $stopData['arrival_time'],
                            'departure_time'      => $stopData['departure_time'],
                            'distance_from_start' => $stopData['distance_from_start'],
                        ]);
                    }
                }
            }

            DB::commit();
            return new TrainResource($train->load('stops'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error'   => 'An error occurred while updating the train.',
                'message' => $e->getMessage()
            ], 500);
        }
    }




    public function destroy(Train $train)
    {
        try {
            DB::beginTransaction();
            $train->stops()->delete();
            $train->delete();
            DB::commit();
            return response()->json(
                [
                    'message'   => 'Train and its stops deleted successfully',
                    'data'      => new TrainResource($train),
                ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => 'Failed to delete train',
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }
}
