<?php

namespace App\Http\Requests\Station;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStationRequest extends StoreStationRequest
{
    public function rules(): array
    {
        $stationId = $this->route('station');
        return array_merge(parent::rules(), [
            'name'          => ['required', 'string', 'max:255'],
            'code'          => [
                                    'required',
                                    'string',
                                    'max:255',
                                    Rule::unique('stations')->ignore($stationId),
                                ],
        ]);

    }

    public function messages(): array
    {
        return array_merge(parent::messages(),
            [
                'code.unique'   => 'The code has already been taken, except for this station.',
            ]);
    }
}
