<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
     */
    public function rules(): array
    {
        
 
        return [
            'user_id' => "sometimes|nullable|string|exists:users,id",
            'room_id' => "sometimes|nullable|string|exists:rooms,id",
            'check_in' => "sometimes|nullable|date",
            'check_out' => "sometimes|nullable|date",
            'status' => "sometimes|nullable|string",
            'guest_name' => "sometimes|nullable|string",
            'guest_email' => "sometimes|nullable|string",
            'guest_phone' => "sometimes|nullable|string",
            'from_date' => "sometimes|nullable|date",
            'to_date' => "sometimes|nullable|date",
        ];
    }
}

