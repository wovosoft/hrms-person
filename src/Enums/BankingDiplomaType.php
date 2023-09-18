<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum BankingDiplomaType: string
{
    use HasEnumExtensions;

    case JAIBB = "jaibb";
    case DAIBB = "daibb";

    public static function fromRaw(?string $name = null): ?BankingDiplomaType
    {
        return match (trim($name)) {
            "DAIBB (1st & 2nd Part)" => self::DAIBB,
            "JAIBB (1st Part)"       => self::JAIBB,
            default                  => null
        };
    }
}
