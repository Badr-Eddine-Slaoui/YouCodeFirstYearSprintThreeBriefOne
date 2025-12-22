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

}