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
            'user_id' => "sometimes|string|exists:users,id",
            'room_id' => "sometimes|string|exists:rooms,id",
            'check_in' => "sometimes|date",
            'check_out' => "sometimes|date",
            'status' => "sometimes|string",
            'guest_name' => "sometimes|string",
            'guest_email' => "sometimes|string",
            'guest_phone' => "sometimes|string",
            'from_date' => "sometimes|date",
            'to_date' => "sometimes|date",
        ];
    }
}

