<?php

namespace App\Http\Requests\API\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'image' => 'sometimes|base64image',
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')->where( function ($builder)  {
                    $builder->where('id', $this->request->get("role_id"));
                })
            ],
        ];
    }
}
