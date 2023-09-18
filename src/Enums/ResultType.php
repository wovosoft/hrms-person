<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum ResultType: string
{
    use HasEnumExtensions;

    case Division   = "division";
    case GPA        = "gpa";
    case Classified = "classified";
    case CGPA       = "cgpa";
}
