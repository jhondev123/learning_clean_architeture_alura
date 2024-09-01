<?php

namespace Jhonattan\CleanArchiteture\Infra\Repositories\PDO;

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;
use Jhonattan\CleanArchiteture\Domain\Interfaces\StudentRepository as StudentRepositoryInterface;


class StudentRepository implements StudentRepositoryInterface
{
    public function __construct(private \PDO $pdo) {}
    public function save(Student $student): void
    {
        $sql = "INSERT INTO students (name, cpf, email) VALUES (:name, :cpf, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':cpf', $student->getStringCpf());
        $stmt->bindValue(':email', (string)$student->getStringEmail());
        if ($stmt->execute()) {
            $this->savePhones($student->getStringCpf(), $student->getPhones());
        }
    }
    public function savePhones(string $cpf, array $phones): void
    {
        $sql = "INSERT INTO phones(cpf_student, number) VALUES (:cpf_student, :phone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':cpf_student', $cpf);
        foreach ($phones as $phone) {
            $stmt->bindValue(':phone', $phone->getPhone());
            $stmt->execute();
        }
    }
    public function searchByCpf(Cpf $cpf): ?Student
    {
        $sql = "SELECT students.*,phones.number as phone_number FROM students 
        INNER JOIN phones ON students.cpf = phones.cpf_student 
        WHERE cpf = :cpf";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':cpf', (string)$cpf);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            $student = Student::createStudentWithCpfNameAndEmail(
                cpf: new Cpf($result['cpf']),
                email: new Email($result['email']),
                name: $result['name']
            )->addPhone($result['phone_number']);

            return $student;
        }
        throw new \PDOException('Student not found');
    }
    public function searchAllStudents(): array
    {
        $sql = "SELECT students.*,phones.number as phone_number FROM students
            INNER JOIN phones ON students.cpf = phones.cpf_student 

        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return array_map(function ($row) {
            $student = Student::createStudentWithCpfNameAndEmail(
                new Cpf($row['cpf']),
                new Email($row['email']),
                $row['name']
            )->addPhone($row['phone_number']);
            return $student;
        }, $stmt->fetchAll(\PDO::FETCH_ASSOC));
    }
}
