<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'room_id' => "sometimes|nullable|string|exists:rooms,id",
            'guest_name' => "sometimes|nullable|string",
            'guest_email' => "sometimes|nullable|string",
            'guest_phone' => 'required|string|size:10',
            'from_date' => "sometimes|nullable|date",
            'to_date' => "sometimes|nullable|date|after_or_equal:to_date",
        ];
    }
}
