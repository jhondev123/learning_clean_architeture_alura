<?php

namespace Jhonattan\CleanArchiteture\Domain\Interfaces;

interface Encryptor
{
    public function encrypt(string $password):string;
    public function verify(string $passwordInText, string $encryptedPassword): bool;
}
