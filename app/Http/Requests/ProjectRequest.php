<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required',
            'client_name' => 'required',
            'lead_developer_id' => 'required|exists:developers,slug',
        ];
    }

    public function messages() 
    {
        return [
            'required' => 'The :attribute cannot be blank.',
            'exists' => 'Lead developer does\'nt exists.',
            'integer' => 'Invalid parameter.'           
        ];
    }
}
