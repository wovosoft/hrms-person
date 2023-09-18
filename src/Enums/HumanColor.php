<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum  HumanColor: string
{
    use HasEnumExtensions;

    case Brown  = "brown";
    case Fair   = "fair";
    case Black  = "black";
    case Others = "others";
}
