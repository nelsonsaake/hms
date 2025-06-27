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
            'type' => "sometimes|string",
            'price' => "sometimes|numeric",
            'beds' => "sometimes|integer",
            'description' => "sometimes|string",
            'status' => "sometimes|string",
            'floor' => "sometimes|integer",
            'number' => "sometimes|integer",
        ];
    }
}

