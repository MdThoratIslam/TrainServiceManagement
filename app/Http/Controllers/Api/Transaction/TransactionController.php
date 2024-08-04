<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\Api\Transaction\TransactionResource;
use App\Http\Resources\Api\Wallet\WalletResource;
use App\Models\Api\Transaction\Transaction;
use App\Models\Api\Wallet\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $wallet = $user->wallet;

            if (!$wallet) {
                return response()->json(['message' => 'No wallet found'], 404);
            }
            return response()->json([
                'message' => 'Funds fetched successfully.',
                'wallet' => new WalletResource($wallet),
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch funds'], 500);
        }
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
    public function store(StoreTransactionRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $wallet = $user->wallet;
            if (!$wallet) {
                $wallet = Wallet::create([
                    'user_id' => $user->id,
                    'balance' => 0,
                ]);
            }
            $amount = $request->amount;
            $wallet->balance += $amount;
            $wallet->save();
            $transaction=$wallet->transactions()->create([
                'amount' => $amount,
                'type' => 'credit',
                'description' => $request->description,
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Funds added successfully.',
                'wallet' => new TransactionResource($transaction),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to add funds'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
