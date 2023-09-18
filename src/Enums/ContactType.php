<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum ContactType: string
{
    use HasEnumExtensions;

    case Email                  = "email";
    case Phone                  = "phone";
    case Fax                    = "fax";
    case Landline               = "tel";
    case PhysicalMailingAddress = "pma";    //physical mailing address
}
