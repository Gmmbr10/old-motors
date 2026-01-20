<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidatorException;

class FormsVeiculoImage
{
    private array $errors = [];

    public function __construct(
        public array $attributes
    ) {}

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
