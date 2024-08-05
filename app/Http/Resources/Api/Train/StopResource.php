<?php

namespace App\Http\Resources\Api\Train;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'train_id'                  => $this->train_id,
            'station_id'                => $this->id,
            'arrival_time'              => $this->arrival_time,
            'departure_time'            => $this->departure_time,
            'distance_from_start'       => $this->distance_from_start
        ];
    }
}
