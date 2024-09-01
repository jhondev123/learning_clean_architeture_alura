<?php

namespace Jhonattan\CleanArchiteture\Domain\ValueObjects;

final class Phone implements \Stringable
{
    public function __construct(private string $phone)
    {
        $this->validatePhoneNumber($phone);
    }
    private function validatePhoneNumber(string $phone): void
    {
        $pattern = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})-?(\d{4}))$/';
        if (!preg_match($pattern, $phone)) {
            throw new \InvalidArgumentException("Invalid phone number format.");
        }
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function __toString()
    {
        return $this->phone;
    }
}
