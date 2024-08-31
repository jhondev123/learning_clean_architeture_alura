<?php

namespace Jhonattan\CleanArchiteture\Domain\Entities;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Phone;

final class Student
{
 private Cpf $cpf;
 private string $name;
 private Email $email;
 private Phone $phone;
}
