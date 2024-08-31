<?php

namespace Jhonattan\CleanArchiteture\Domain\ValueObjects;

final class Email implements \Stringable
{

    public function __construct(private string $address)
    {
        if (!$this->validateEmail($address)) {
            throw new \InvalidArgumentException('Invalid email address');
        }
    }
    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function __toString()
    {
        return $this->address;
    }
}
