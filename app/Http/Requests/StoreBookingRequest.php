<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'user_id' => 'required|string|exists:users,id',
            'room_id' => 'required|string|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'status' => 'required|string',
            'guest_name' => 'required|string',
            'guest_email' => 'required|string',
            'guest_phone' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ];
    }
}

