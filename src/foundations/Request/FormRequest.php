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
                return filter_var($value, FILTER_VALIDATE_INT);
            case str_contains($rule, 'min:'):
                if(filter_var($value, FILTER_VALIDATE_INT)) {
                    return (int) $value <= (int) str_replace('min:', '', $rule);
                }
                return strlen($value) >= (int) str_replace('min:', '', $rule);
            case str_contains($rule, 'max:'):
                if(filter_var($value, FILTER_VALIDATE_INT)) {
                    return (int) $value <= (int) str_replace('max:', '', $rule);
                }
                return strlen($value) <= (int) str_replace('max:', '', $rule);
            case str_contains($rule, "between:"):
                $range = explode(',', str_replace('between:', '', $rule));
                if(filter_var($value, FILTER_VALIDATE_INT)) {
                    return (int) $value >= (int) $range[0] && (int) $value <= (int) $range[1];
                };
                return strlen($value) >= (int) $range[0] && strlen($value) <= (int) $range[1];
            case str_contains($rule,'in:'):
                $enum = explode(',', str_replace('in:', '', $rule));
                return in_array($value, $enum);
            default:
                return false;
        }
    }

    public static function setError(string $attribute, string $rule) {
        $fullRule = $rule;
        
        if(str_contains($rule,':')) {
            $rule = explode(':', $rule)[0];
        }

        if (isset(static::$messages["$attribute.$rule"])) {
            static::$errors[$attribute] = static::$messages["$attribute.$rule"];
        } else {
            $message = match($rule) {
                "required" => "$attribute is required",
                "email" => "Email is invalid",
                "string" => "$attribute must be a string",
                "int" => "$attribute must be an integer",
                "min" => function () use ($attribute, $fullRule) {
                    $min = explode(':', $fullRule)[1];
                    return "$attribute must be at least $min characters";
                },
                "max" => function () use ($attribute, $fullRule) {
                    $max = explode(":", $fullRule)[1];
                    return "$attribute must be at most $max characters";
                },
                "between" => function () use ($attribute, $fullRule) {
                    $range = explode(":", $fullRule)[1];
                    $min = explode(",", $range)[0];
                    $max = explode(",", $range)[1];
                    return "$attribute must be between $min and $max characters";
                },
                "in" => function () use ($attribute, $fullRule) {
                    $enum = explode(":", $fullRule)[1];
                    $enum = implode(", ", explode(",", $enum));
                    return "$attribute must be one of $enum";
                },
                default => "$attribute is invalid",
            };

            if(!is_string($message)){
                static::$errors[$attribute] = $message();
            }else{
                static::$errors[$attribute] = $message;
            }
        }
    }

    public static function validateAttribute(string $attribute, $value, array $rules): bool {
        foreach ($rules as $rule) {
            if (is_string($rule)) {
                if (!static::validateRule($rule, $value)) {
                    static::setError($attribute, $rule);
                    return false;
                }
            }
        }
        return true;
    }

    public static function validate(Request $request): void {
        $attributes = array_keys(self::$rules);

        foreach ($attributes as $attribute) {
            $value = $request->input($attribute);

            $attributeRules = explode('|', self::$rules[$attribute]);
            
            static::validateAttribute($attribute, $value, $attributeRules);

        }

        if (!empty(static::$errors)) {
            Session::flash('errors', static::$errors);
            header('Location: ' . $request->header("HTTP_REFERER"));
            exit();
        }
    }

    public static function handleValidationErrors() {
        self::$rules = static::rules();
        self::$messages = static::messages();
        $request = static::request();
        static::validate($request);
    }

}