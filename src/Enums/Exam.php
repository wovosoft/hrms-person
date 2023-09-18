<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum Exam: string
{
    use HasEnumExtensions;

    case PSC                = "psc";
    case JSC                = "jsc";
    case SSC                = "ssc";
    case HSC                = "hsc";
    case GRADUATION_PASS    = "graduation_pass";
    case GRADUATION_HONOURS = "graduation_honours";
    case POST_GRADUATION    = "post_graduation";
    case BELLOW_SSC         = "bellow_ssc";
}
