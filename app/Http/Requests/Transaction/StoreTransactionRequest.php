<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'wallet_id'             => 'exists:wallets,id',
            'amount'                => 'required|min:0',
            'type'                  => 'in:credit,debit',
            'description'           => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'wallet_id.exists'      => 'Wallet is not exists',
            'amount.required'       => 'Amount is required',
            'amount.decimal'        => 'Amount must be decimal',
            'amount.min'            => 'Amount must be greater than 0',
            'type.in'               => 'Type must be credit or debit',
            'description.string'    => 'Description must be string',
        ];
    }
}
