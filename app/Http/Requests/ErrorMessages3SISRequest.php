<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorMessages3SISRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'FYFYHStartDate'        => 'required',
        ];
    }

    public function messages()
    {
        return [
                'FYFYHStartDate.required' => 'Start Date cant be blank Shishir.',
        ];
    }
}
