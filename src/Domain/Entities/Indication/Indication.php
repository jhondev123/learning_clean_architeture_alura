<?php

namespace Jhonattan\CleanArchiteture\Domain\Entities\Indication;

use DateTimeImmutable;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;

class Indication
{

    public function __construct(
        private Student $indicator,
        private Student $indicated,
        private \DateTimeImmutable $data
    ) {
        $this->data = new DateTimeImmutable();
    }
}
