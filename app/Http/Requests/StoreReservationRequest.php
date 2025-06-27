<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'room_id' => 'required|string|exists:rooms,id',
            'guest_name' => 'required|string',
            'guest_email' => 'required|string',
            'guest_phone' => 'required|string',
            'from_date' => 'sometimes|nullable|date',
            'to_date' => 'sometimes|nullable|date',
        ];
    }
}
