<?php

use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;
use Jhonattan\CleanArchiteture\Config\DatabaseConnection;
use Jhonattan\CleanArchiteture\Infra\Repositories\PDO\StudentRepository;

require_once __DIR__ . "/vendor/autoload.php";



$pdo = DatabaseConnection::getConnection();

$studentRepository = new StudentRepository($pdo);
$student = $studentRepository->searchByCpf(new Cpf('136.125.999-09'));
var_dump($student->getName());
