<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class SubmissionData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $message;
}
