<?php

namespace App\Http\Requests\API\Admin;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'email' => ['email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => 'required|min:6',
            'image' => 'sometimes|base64image',
        ];
    }
}
