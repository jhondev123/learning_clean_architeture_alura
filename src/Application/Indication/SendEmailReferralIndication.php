<?php

namespace Jhonattan\CleanArchiteture\Application\Indication;

use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;

interface SendEmailReferralIndication
{
    public function sendEmailForIndicatedStudentAndIndicatorStudent(Student $indicatedStudent,Student $indicatorStudent): void;
}
