<?php

namespace Jhonattan\CleanArchiteture\Tests\Infra\Repositories\PDO;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;
use Jhonattan\CleanArchiteture\Infra\Repositories\PDO\StudentRepository;

class StudentRepositoryTest extends TestCase
{
    private \PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("
            CREATE TABLE students (
                cpf TEXT PRIMARY KEY,
                name TEXT,
                email TEXT
            );
            CREATE TABLE phones (
                number TEXT,
                cpf_student TEXT,
                PRIMARY KEY (number),
                FOREIGN KEY (cpf_student) REFERENCES students(cpf)
            );
        ");
    }
    public static function studentsData()
    {
        return [
            ['123.456.789-00', 'John Doe', 'john.doe@example.com', '45999338406'],
            ['987.654.321-00', 'Jane Doe', 'jane.doe@example.com', '45999338406'],
            ['111.222.333-44', 'Alice Smith', 'alice.smith@example.com', '45999338406']
        ];
    }
    #[DataProvider('studentsData')]
    public function testSearchStudentById(string $cpf, string $name, string $email, string $phone)
    {
        $this->insertStudent($cpf, $name, $email, $phone);
        $repository = new StudentRepository($this->pdo);
        $result = $repository->searchByCpf(new Cpf($cpf));
        $this->assertInstanceOf(Student::class, $result);
        $this->assertEquals($cpf, $result->getStringCpf());
        $this->assertEquals($name, $result->getName());
        $this->assertEquals($email, $result->getStringEmail());
        $this->assertEquals($phone, $result->getPhones()[0]);
    }
    #[DataProvider('studentsData')]
    public function testSearchAllStudents(string $cpf, string $name, string $email, string $phone)
    {
        $this->insertStudent($cpf, $name, $email, $phone);
        $repository = new StudentRepository($this->pdo);
        $result = $repository->searchAllStudents();
        $this->assertCount(1, $result);
        $this->assertEquals($cpf, $result[0]->getStringCpf());
        $this->assertEquals($name, $result[0]->getName());
        $this->assertEquals($email, $result[0]->getStringEmail());
    }
    public function testeSaveStudent()
    {
        $cpf = '123.456.789-00';
        $email = 'john.doe@example.com';
        $name = 'John Doe';
        $student = Student::createStudentWithCpfNameAndEmail(
            new Cpf($cpf),
            new Email($email),
            $name
        )->addPhone('45999338406');
        $repository = new StudentRepository($this->pdo);
        $repository->save($student);
        $this->assertEquals($name, $this->pdo->query("SELECT name FROM students WHERE cpf = '$cpf'")->fetchColumn());
        $this->assertEquals($email, $this->pdo->query("SELECT email FROM students WHERE cpf = '$cpf'")->fetchColumn());
        $this->assertEquals($cpf, $this->pdo->query("SELECT cpf FROM students WHERE cpf = '$cpf'")->fetchColumn());
    }










    public function insertStudent(string $cpf, string $name, string $email, string $phone)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO students (cpf, name, email) 
            VALUES (:cpf, :name, :email)
        ");
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $stmt = $this->pdo->prepare("
            INSERT INTO phones (number, cpf_student) 
            VALUES (:phone, :cpf)
        ");
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();
    }
}
