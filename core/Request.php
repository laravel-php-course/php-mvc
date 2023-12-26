<?php

namespace App\core;

class Request
{
    public array $errors = [];

    public const RULE_REQUIRED = 'req';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/'; //  /user?id=12
        $position = strpos($path, '?');

        if (!$position) return $path;

        return substr($path, 0, $position);
    }

    public function Method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getBody(): array
    {
        $body = [];
        
        foreach ($_REQUEST as $key => $value)
        {
            $body[$key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $body;
    }

    public function loadData(array $data)
    {

        foreach ($data as $key => $value)
        {
            if (property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {

        foreach ($this->rules() as $attr => $rules)
        {
            $value = $this->{$attr};

            foreach ($rules as $rule) {
                $ruleName = '';

                if (is_string($rule)) $ruleName = $rule;
//                elseif (is_array($rule)) $ruleName = $rule[0];

                if ($ruleName === self::RULE_REQUIRED and empty($value)) {
                    $this->addError($attr, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL and !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attr, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN and strlen($value) < $rule['min']) {
                    $this->addError($attr, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX and strlen($value) > $rule['max']) {
                    $this->addError($attr, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH and $value !== $this->{$rule['match']}) {
                    $this->addError($attr, self::RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    public function rules(): array
    {
        return [];
    }

    public function addError(int|string $attr, string $rule, array $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
//        foreach ($params as $key => $value)
//        {
//            $message = str_replace("{{$key}}", $value, $message);
//        }
        $this->errors[$attr][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
        ];
    }

    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }

    public function hasError(string $attribute): bool
    {
        return !empty($this->errors[$attribute]);
    }

    public function old(string $attribute): string
    {
        return $this->{$attribute} ?? '';
    }
}