<?php

namespace App\Requests;

use Foundations\Request\FormRequest;

class FormRequestName extends FormRequest {
    public static function authorize(): bool {
        return true;
    }

    public static function rules(): array {
        return [

        ];
    }

    public static function messages(): array {
        return [

        ];
    }
}