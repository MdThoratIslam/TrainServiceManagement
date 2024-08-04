<?php

namespace App\Http\Controllers\Api\Train;

use App\Http\Controllers\Controller;
use App\Http\Requests\Train\stop\StoreStopRequest;
use App\Http\Requests\Train\stop\UpdateStopRequest;
use App\Models\Api\Train\Stop;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreStopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stop $stop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stop $stop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStopRequest $request, Stop $stop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stop $stop)
    {
        //
    }
}
