<?php

namespace Foundations\Request;

use Foundations\Helpers\Session;

abstract class FormRequest extends Request {
    protected static array $errors = [];
    protected static array $attributes = [];
    protected static array $rules = [];
    protected static array $messages = [];

    abstract public static function authorize(): bool;
    
    abstract public static function rules(): array;

    abstract public static function messages(): array;

    public static function request(): Request{
        return new Request();
    }

    public static function validateRule(string $rule, $value): bool {
        switch ($rule) {
            case 'required':
                return !empty($value);
            case 'email':
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            case 'string':
                return is_string($value);
            case 'int':
                return is_int($value);
            case str_contains($rule, 'min:'):
                return strlen($value) >= (int) str_replace('min:', '', $rule);
            case str_contains($rule, 'max:'):
                return strlen($value) <= (int) str_replace('max:', '', $rule);
            case str_contains($rule, "between:"):
                $range = explode(',', str_replace('between:', '', $rule));
                return strlen($value) >= (int) $range[0] && strlen($value) <= (int) $range[1];
            case str_contains($rule,'in:'):
                $enum = explode(',', str_replace('in:', '', $rule));
                return in_array($value, $enum);
            default:
                return false;
        }
    }

}