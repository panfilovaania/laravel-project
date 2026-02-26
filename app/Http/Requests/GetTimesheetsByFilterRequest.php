<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetTimesheetsByFilterRequest extends FormRequest
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
            'entity_type_id' => 'required|numeric|exists:entity_types,id',
            'timesheet_status_id' => 'required|numeric|exists:timesheet_statuses,id',
            'entity_id' => 'required|numeric',
            'date' => 'required|date|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i'
        ];
    }
}
