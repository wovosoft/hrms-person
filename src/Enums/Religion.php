<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum Religion: string
{
    use HasEnumExtensions;

    case Hinduism     = "h";
    case Islam        = "i";
    case Christianity = "c";
    case Buddhism     = "b";
    case Ethnicity    = "e";
    case Others       = "o";
}
