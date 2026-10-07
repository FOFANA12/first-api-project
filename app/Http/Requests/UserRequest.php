<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->user instanceof User ? $this->user->id : $this->user;

        $rules = [
            'name' => 'bail|required|min:3|max:50',
            'password' => 'bail|required|min:6|confirmed',
            'email' => 'bail|required|email|max:100|unique:users,email',
        ];

        if ($this->method() === 'PUT') {
            $rules['email'] = 'bail|required|email|max:100|unique:users,email,' . $id . ',id';
        }

        return $rules;
    }
}
