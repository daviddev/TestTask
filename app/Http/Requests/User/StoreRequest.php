<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:80'],
            'phone_number' => ['required', 'string', 'min:2', 'max:30', 'regex:/^[+]?[\d]+$/i'],
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => 'The phone number format is invalid. (use only + and numbers)',
        ];
    }
}
