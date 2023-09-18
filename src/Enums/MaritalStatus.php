<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum MaritalStatus: string
{
    use HasEnumExtensions;

    case Single         = "s";
    case Married        = "m";
    case Divorced       = "d";
    case LivingTogether = "lt";
    case Other          = "o";
}
