<?php

namespace Jhonattan\CleanArchiteture\Infra\Services\EmailSender;

use Jhonattan\CleanArchiteture\Application\Indication\SendEmailReferralIndication;
use Jhonattan\CleanArchiteture\Domain\Entities\Student\Student;

class EmailSenderWithPhpMail implements SendEmailReferralIndication
{
    public function sendEmailForIndicatedStudentAndIndicatorStudent(Student $indicatedStudent, Student $indicatorStudent): void
    {
        mail(
            $indicatedStudent->getStringEmail(),
            'Referral Notification',
            "Congratulations! You have been referred by {$indicatorStudent->getName()}."
        );
    }
}
