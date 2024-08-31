<?php

namespace Jhonattan\CleanArchiteture\Domain\ValueObjects;


final class Cpf implements \Stringable
{
    private string $number;

    public function __construct(string $number)
    {
        $this->setNumber($number);
    }

    public function getNumber(): string
    {
        return $this->number;
    }
    private function setNumber(string $numero)
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/'
            ]
        ];
        if (filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) == false) {
            throw new \InvalidArgumentException(message: 'CPF no formato inválido');
        }
        $this->number = $numero;
    }
    public function __toString()
    {
        return $this->number;
    }
}
