<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'type' => "sometimes|nullable|string",
            'price' => "sometimes|nullable|numeric",
            'beds' => "sometimes|nullable|integer",
            'description' => "sometimes|nullable|string",
            'status' => "sometimes|nullable|string",
            'floor' => "sometimes|nullable|integer",
            'number' => "sometimes|nullable|integer",
        ];
    }
}

