<?php

namespace Jhonattan\CleanArchiteture\Domain\Entities;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Phone;

final class Student
{
    private string $name;
    private Cpf $cpf;
    private Email $email;
    /** @var Phone */
    private array $phone;

    public static function createStudentWithCpfNameAndEmail(Cpf $cpf, Email $email, string $name):self 
    {

        return new Student(
            new Cpf($cpf),
            new Email($email),
            $name
        );
    }

    public function __construct(Cpf $cpf, Email $email, string $name) {}

    public function addPhone(string $phone): self
    {
        $this->phone[] = new Phone($phone);
        return $this;
    }
}
