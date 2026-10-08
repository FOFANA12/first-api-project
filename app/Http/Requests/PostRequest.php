<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'bail|required|integer|exists:users,id',
            'title' => 'bail|required|min:3|max:255',
            'content' => 'bail|required',
            'published_at' => 'bail|nullable|date',
        ];
    }
}
