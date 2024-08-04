<?php

namespace App\Http\Resources\Api\Wallet;

use App\Http\Resources\Api\Transaction\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'balance'           => $this->balance,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'transactions'      => TransactionResource::collection($this->transactions),
        ];
    }
}
