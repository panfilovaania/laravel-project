<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'name' => 'required|unique:services|string|max:100',
            'label' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'available' => 'boolean',
        ];
    }
}
