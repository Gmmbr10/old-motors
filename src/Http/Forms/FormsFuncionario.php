<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidatorException;

class FormsFuncionario
{
    private array $errors = [];

    public function __construct(
        public array $attributes
    ) {
        if (!Validator::string($attributes['fullname'])) {
            $this->errors['fullname'] = 'Por favor, preencha o nome completo!';
        }

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Por favor, preencha com um email valido!';
        }

        if (!Validator::position($attributes['position'])) {
            $this->errors['position'] = 'Por favor, selecione um cargo válido!';
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
