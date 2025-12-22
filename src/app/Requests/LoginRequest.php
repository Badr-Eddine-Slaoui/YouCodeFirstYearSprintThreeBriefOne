<?php

namespace App\Requests;

use Foundations\Request\FormRequest;

class LoginRequest extends FormRequest {
    public static function authorize(): bool {
        return true;
    }

    public static function rules(): array {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public static function messages(): array {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid'
        ];
    }
}