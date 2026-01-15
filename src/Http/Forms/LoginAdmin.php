<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidatorException;

class LoginAdmin
{
    private array $errors = [];

    public function __construct(
        public array $attributes
    ) {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Por favor, preencha com um email valido!';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Por favor, preencha a senha!';
        }
    }

    public static function validate(array $attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed(): int
    {
        return count($this->errors);
    }

    public function throw(): void
    {
        ValidatorException::throw($this->errors, $this->attributes);
    }

    public function error(string $field, string $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
