<?php

namespace App\Models\Api\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    /*
     * Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('start_stop_id')->constrained('stops')->onDelete('cascade');
            $table->foreignId('end_stop_id')->constrained('stops')->onDelete('cascade');
            $table->decimal('fare', 15, 2);
            $table->timestamps();
        });*/
    protected $fillable = ['user_id', 'train_id', 'start_stop_id', 'end_stop_id', 'fare'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function start_stop()
    {
        return $this->belongsTo(Stop::class, 'start_stop_id', 'id');
    }
    public function end_stop()
    {
        return $this->belongsTo(Stop::class, 'end_stop_id', 'id');
    }
}
