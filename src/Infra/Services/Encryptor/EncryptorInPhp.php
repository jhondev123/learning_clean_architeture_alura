<?php

namespace Jhonattan\CleanArchiteture\Infra\Services\Encryptor;

use Jhonattan\CleanArchiteture\Domain\Interfaces\Encryptor;

class EncryptorInPhp implements Encryptor
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
    public function verify(string $passwordInText, string $encryptedPassword): bool
    {
        return password_verify($passwordInText, $encryptedPassword);
    }
}
