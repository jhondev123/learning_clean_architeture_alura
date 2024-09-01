<?php

namespace Jhonattan\CleanArchiteture\Application\UseCases;

use DateTimeImmutable;
use Jhonattan\CleanArchiteture\Domain\Entities\Student;

class IndicationUseCase
{


    public function __construct(
        private Student $indicator, 
        private Student $indicated,
        private \DateTimeImmutable $data
        ) {
            $this->data = new DateTimeImmutable();
        }
}
