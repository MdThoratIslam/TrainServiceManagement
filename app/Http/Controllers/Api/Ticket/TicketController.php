<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Http\Resources\Api\Ticket\TicketResource;
use App\Models\Api\Ticket\Ticket;
use App\Models\Api\Train\Stop;
use App\Models\Api\Train\Train;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        //
    }
    public function store(StoreTicketRequest $request)
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        if (!$wallet) {
            return response()->json(['error' => 'Wallet not found.'], 404);
        }
        $train = Train::findOrFail($request->train_id);
        $startStop = Stop::findOrFail($request->start_stop_id);
        $endStop = Stop::findOrFail($request->end_stop_id);

        // Ensure the stops belong to the train and the end stop is after the start stop
        if ($startStop->train_id !== $train->id || $endStop->train_id !== $train->id) {
            return response()->json(['error' => 'Invalid stops for the selected train.'], 400);
        }
        if ($endStop->distance_from_start <= $startStop->distance_from_start) {
            return response()->json(['error' => 'End stop must be after the start stop.'], 400);
        }

        // Calculate fare based on the distance
        $fare = $this->calculateFare($startStop, $endStop);

        if ($wallet->balance < $fare) {
            return response()->json(['error' => 'Insufficient funds in wallet.'], 400);
        }

        DB::beginTransaction();

        try {
            // Deduct fare from wallet
            $wallet->balance -= $fare;
            $wallet->save();

            // Create ticket
            $ticket = Ticket::create([
                'user_id' => $user->id,
                'train_id' => $train->id, // Ensure train_id is set correctly
                'start_stop_id' => $startStop->id,
                'end_stop_id' => $endStop->id,
                'fare' => $fare,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Ticket purchased successfully.',
                'ticket' => new TicketResource($ticket),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to purchase ticket.', 'message' => $e->getMessage()], 500);
        }
    }
    private function calculateFare(Stop $startStop, Stop $endStop): float
    {
//        $startDepartureTime         = Carbon::parse($startStop->departure_time);
//        $endArrivalTime             = Carbon::parse($endStop->arrival_time);
//        $distance                   = $endArrivalTime->diffInMinutes($startDepartureTime);
//        $fare                       = $distance * 0.5;
//        return $fare;

        // Calculate distance between stops
        $distance = $endStop->distance_from_start - $startStop->distance_from_start;

        $fare = max($distance * 0.5, 0); // Example: 0.5 currency units per distance unit
        return $fare;
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
