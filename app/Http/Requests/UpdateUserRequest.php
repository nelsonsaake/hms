<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userEmail = $this->route('user')->email;
        
 
        return [
            'name' => "sometimes|nullable|string",
            'email' => "sometimes|nullable|string|unique:users,email,$userEmail",
        ];
    }
}
