<?php

namespace App\Http\Requests\Train;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainRequest extends FormRequest
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
            'name'                      => 'required|string|max:255',
            'code'                      => 'required|integer',
            'stops'                     => 'required|array',
            'stops.*.station_id'        => 'required|integer|exists:stations,id',
            'stops.*.arrival_time'      => 'required|date_format:H:i:s',
            'stops.*.departure_time'    => 'required|date_format:H:i:s|after_or_equal:stops.*.arrival_time',
            'stops.*.distance_from_start' => 'required|numeric|min:0|max:999999.99',
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'                         => 'The train name is required.',
            'name.string'                           => 'The train name must be a string.',
            'name.max'                              => 'The train name may not be greater than 255 characters.',
            'code.required'                         => 'The train code is required.',
            'code.string'                           => 'The train code must be a integer.',
            'stops.required'                        => 'The stops are required.',
            'stops.array'                           => 'The stops must be an array.',
            'stops.*.station_id.required'           => 'The station ID is required for each stop.',
            'stops.*.station_id.integer'            => 'The station ID must be an integer.',
            'stops.*.station_id.exists'             => 'The station ID must exist in the stations table.',
            'stops.*.arrival_time.required'         => 'The arrival time is required for each stop.',
            'stops.*.arrival_time.date_format'      => 'The arrival time must be in the format H:i:s.',
            'stops.*.departure_time.required'       => 'The departure time is required for each stop.',
            'stops.*.departure_time.date_format'    => 'The departure time must be in the format H:i:s.',
            'stops.*.departure_time.after_or_equal' => 'The departure time must be after or equal to the arrival time for each stop.',
            'stops.*.distance_from_start.required'  => 'The distance from start is required for each stop.',
            'stops.*.distance_from_start.numeric'   => 'The distance from start must be a numeric value.',
            'stops.*.distance_from_start.min'       => 'The distance from start must be at least 0.',
            'stops.*.distance_from_start.max'       => 'The distance from start may not be greater than 999999.99.',
        ];
    }
}
