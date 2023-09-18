<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum AddressType: string
{
    use HasEnumExtensions;

    case PRESENT   = "present";
    case PERMANENT = "permanent";
}
