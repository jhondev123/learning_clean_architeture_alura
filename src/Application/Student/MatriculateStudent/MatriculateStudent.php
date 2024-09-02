<?php

namespace Jhonattan\CleanArchiteture\Application\Student\MatriculateStudent;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;
use Jhonattan\CleanArchiteture\Domain\Interfaces\StudentRepository;

class MatriculateStudent
{
    public function __construct(private StudentRepository $repository) {}
    public function execute(MatriculateStudentDTO $matriculateStudentDTO): void
    {

        $student = Student::createStudentWithCpfNameAndEmail(
            new Cpf($matriculateStudentDTO->cpfStudent),
            new Email($matriculateStudentDTO->emailStudent),
            $matriculateStudentDTO->nameStudent
        );
        $this->repository->save($student);
    }
}
