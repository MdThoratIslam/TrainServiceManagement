<?php

namespace App\Http\Requests\Station;

use Illuminate\Foundation\Http\FormRequest;

class StoreStationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:255',
            'code'                  => 'required|string|max:255|unique:stations',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name must be a string.',
            'name.max'              => 'The name may not be greater than 255 characters.',
            'code.required'         => 'The code field is required.',
            'code.string'           => 'The code must be a string.',
            'code.max'              => 'The code may not be greater than 255 characters.',
            'code.unique'           => 'The code has already been taken.',
        ];
    }
}
