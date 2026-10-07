<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class TaskRequest extends FormRequest
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
        return [
            'title' => 'bail|required|min:3|max:50',
            'description' => 'bail|nullable|max:1000',
            'project_id' => 'bail|required|integer|exists:projects,id',
            'status' => ['bail', 'required', Rule::in(['pending', 'in_progress', 'done'])],
        ];
    }


    #[Override]
    public function attributes()
    {
        return [
            'project_id' => 'project'
        ];
    }
}
