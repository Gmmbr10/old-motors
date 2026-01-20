<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidatorException;

class FormsVeiculo
{
    private array $errors = [];

    public function __construct(
        public array $attributes
    ) {
        if (!Validator::string($attributes['mark'])) {
            $this->errors['mark'] = 'Por favor, preencha a marca do veículo!';
        }

        if (!Validator::string($attributes['model'])) {
            $this->errors['model'] = 'Por favor, preencha o modelo do veículo!';
        }

        if (!Validator::number($attributes['year'], 1886, date('Y'))) {
            $this->errors['year'] = 'Por favor, preencha o ano do veículo!';
        }

        if (!Validator::string($attributes['carPlate'], 7, 7)) {
            $this->errors['carPlate'] = 'Por favor, preencha a placa do veículo! Sem espaços ou caracteres especiais!';
        }

        if (!Validator::number($attributes['price'], 0.01)) {
            $this->errors['price'] = 'Por favor, preencha o preço do veículo!';
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
