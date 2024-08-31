<?php
namespace Jhonattan\CleanArchiteture\Tests\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Email;

class EmailTest extends TestCase
{
    public static function generateInvalidEmail()
    {
        return ["Email Invalid" => ["john.doeexample.com"]];
    }
    public static function generateValidEmail()
    {
        return ["Email Valid" => ["john.doe@example.com"]];
    }
    #[DataProvider('generateInvalidEmail')]
    public function testInvalidEmail(string $email)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid email address');
        new Email($email);
    }
    #[DataProvider('generateValidEmail')]
    public function testValidEmail(string $email)
    {
        $this->assertEquals($email, (string) new Email($email));
    }
}
