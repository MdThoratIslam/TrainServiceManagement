<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
     *     Schema::create('tickets', function (Blueprint $table) {
     * $table->id();
     * $table->foreignId('user_id')->constrained()->onDelete('cascade');
     * $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
     * $table->foreignId('start_stop_id')->constrained('stops')->onDelete('cascade');
     * $table->foreignId('end_stop_id')->constrained('stops')->onDelete('cascade');
     * $table->decimal('fare', 15, 2);
     * $table->timestamps();
     * });
     */
    public function rules(): array
    {
        return [
            //
            'ticket_id' => 'required|exists:tickets,id',
            'start_stop_id' => 'required|exists:stops,id',
            'end_stop_id' => 'required|exists:stops,id',
        ];
    }
    //need message
    public function messages(): array
    {
        return [
            'ticket_id.required'        => 'Ticket ID is required',
            'ticket_id.exists'          => 'Ticket ID does not exist',
            'start_stop_id.required'    => 'Start Stop ID is required',
            'start_stop_id.exists'      => 'Start Stop ID does not exist',
            'end_stop_id.required'      => 'End Stop ID is required',
            'end_stop_id.exists'        => 'End Stop ID does not exist',
        ];
    }
}
