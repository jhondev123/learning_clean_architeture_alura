<?php

namespace Jhonattan\CleanArchiteture\Tests\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Cpf;

class CpfTest extends TestCase
{
    public static function generateCorrectCpf()
    {
        return ["Correct Cpf" => ["123.456.789-00"]];
    }
    public static function generateIncorrectCpf()
    {
        return ["Incorrect Cpf" => ["00000000000"]];
    }
    #[DataProvider('generateIncorrectCpf')]
    public function testValidateCpfIsIncorrect(string $cpf)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('CPF no formato inválido');
        new Cpf($cpf);
    }
    #[DataProvider('generateCorrectCpf')]
    public function testValidateCpfIsCorrect(string $cpf)
    {
        $this->assertEquals($cpf, (string) new Cpf($cpf));
    }
}
