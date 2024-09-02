<?php

namespace Jhonattan\CleanArchiteture\Application\Student\MatriculateStudent;

class MatriculateStudentDTO
{
    public function __construct(
        public string $cpfStudent,
        public string $nameStudent,
        public string $emailStudent,

    )
    {
        
    }
}
