<?php

namespace Jhonattan\CleanArchiteture\Infra\Services\Encryptor;

use Jhonattan\CleanArchiteture\Domain\Interfaces\Encryptor;

class EncryptorInMd5 implements Encryptor
{
    public function encrypt(string $password): string
    {
        return md5($password);
    }
    public function verify(string $passwordInText, string $encryptedPassword): bool
    {
        return $this->encrypt($passwordInText) === $encryptedPassword;
    }
}
