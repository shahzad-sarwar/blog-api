<?php

namespace App\Http\Requests\API\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
            'image' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:1000',
            'slug' => 'required|unique:posts,slug',
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
        ];
    }
}
