<?php

namespace Jhonattan\CleanArchiteture\Domain\Entities\Student;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Phone;

final class Student
{
    private string $name;
    private Cpf $cpf;
    private Email $email;
    private array $phone;

    public static function createStudentWithCpfNameAndEmail(Cpf $cpf, Email $email, string $name): self
    {

        return new Student(
            new Cpf($cpf),
            new Email($email),
            $name
        );
    }

    public function __construct(Cpf $cpf, Email $email, string $name)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    public function addPhone(string $phone): self
    {
        $this->phone[] = new Phone($phone);
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getCpf(): Cpf
    {
        return $this->cpf;
    }
    public function getStringCpf(): string
    {
        return $this->cpf;
    }
    public function getEmail(): Email
    {
        return $this->email;
    }
    public function getStringEmail(): string
    {
        return $this->email;
    }
    public function getPhones(): array
    {
        return $this->phone;
    }
}
