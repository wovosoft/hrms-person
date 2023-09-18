<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum IdentificationType: string
{
    use HasEnumExtensions;

    case NID                = "nid";
    case Driving_License    = "driving_license";
    case Passport           = "passport";
    case Birth_Registration = "birth_registration";
    case TIN                = "tin";
    case BIN                = "bin";
    case Job_ID             = "job_id";
}
