<?php

namespace Jhonattan\CleanArchiteture\Tests\Domain;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Jhonattan\CleanArchiteture\Domain\ValueObjects\Phone;

class PhoneTest extends TestCase
{
    public static function incorrectPhone()
    {
        return ["Incorrect Phone" => ["()99988-1243"]];
    }
    public static function correctPhone()
    {

        return ["Correct Phone" => ["45999338406"]];
    }


    #[DataProvider('correctPhone')]
    public function testValidPhoneNumber(string $phone)
    {
        $this->assertEquals($phone, (string) new Phone($phone));
    }
    #[DataProvider('incorrectPhone')]
    public function testInvalidPhoneNumber(string $phone)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid phone number format.');
        new Phone($phone);
    }
}
