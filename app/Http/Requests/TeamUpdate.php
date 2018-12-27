<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamUpdate extends FormRequest
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
            'id' => 'required',
            'name' => 'required|max:30|min:2',
            'color' => 'required|starts_with:#|max:7|min:7',
            'overview' => 'required|min:20',
            'logo' => 'required|url'
        ];
    }
}
