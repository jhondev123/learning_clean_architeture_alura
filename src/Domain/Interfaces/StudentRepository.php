<?php

namespace Jhonattan\CleanArchiteture\Domain\Interfaces;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;

interface StudentRepository
{
    public function save(Student $student): void;
    public function searchByCpf(Cpf $cpf): ?Student;
    /** @return Student[] */
    public function searchAllStudents(): array;

}
