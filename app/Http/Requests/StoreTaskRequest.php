<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => ['required'],
            'project_id' => ['required', 'integer'],
            'priority' => ['required', 'integer', 'min:1'],
            'description' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'The project is required',
            'project_id.integer' => 'Please select project from dropdown.',
        ];
    }
}
