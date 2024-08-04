<?php

namespace App\Models\Api\Transaction;

use App\Models\Api\Wallet\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['wallet_id', 'amount', 'type', 'description'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
