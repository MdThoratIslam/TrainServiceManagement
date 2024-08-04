<?php

namespace App\Models\Api\Train;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;
    protected $fillable = ['name','code'];

    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}
