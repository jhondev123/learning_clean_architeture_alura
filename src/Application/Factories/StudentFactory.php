<?php

namespace Jhonattan\CleanArchiteture\Application\Factories;

use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;

class StudentFactory
{
    private Student $student;
    public function createStudentWithNameEmailCpf(string $name, string $email, string $cpf): self
    {
        $this->student = new Student(
            name: $name,
            email: new Email($email),
            cpf: new Cpf($cpf)
        );
        return $this;
    }
    public function addPhone(string $phone): self
    {
        $this->student->addPhone($phone);
        return $this;
    }
    public function getStudent(): Student
    {
        return $this->student;
    }
}
