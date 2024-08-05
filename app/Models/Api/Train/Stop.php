<?php

namespace App\Models\Api\Train;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;




    protected $fillable = ['train_id', 'station_id', 'arrival_time', 'departure_time','distance_from_start'];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }
    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
