<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HasPermissionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'scope' => 'required|string|max:255|exists:permissions,scope',
            'action' => 'required|string|max:255|exists:permissions,action',
        ];
    }
}
