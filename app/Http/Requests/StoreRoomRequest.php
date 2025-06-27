<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'type' => 'required|string',
            'price' => 'required|numeric',
            'beds' => 'required|integer',
            'description' => 'required|string',
            'status' => 'required|string',
            'floor' => 'required|integer',
            'number' => 'required|integer',
        ];
    }
}

