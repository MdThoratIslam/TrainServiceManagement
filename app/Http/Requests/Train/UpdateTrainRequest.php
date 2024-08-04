<?php

namespace App\Http\Requests\Train;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTrainRequest extends StoreTrainRequest
{
    public function rules(): array
    {
        $trainId = $this->route('train')->id;
        return array_merge(parent::rules(), [
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'integer',
                Rule::unique('trains')->ignore($trainId),
            ],
        ]);
    }

    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'code.unique' => 'The code has already been taken, except for this train.',
        ]);
    }
}
