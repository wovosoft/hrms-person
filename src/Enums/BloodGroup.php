<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum BloodGroup: string
{
    use HasEnumExtensions;

    case A_POSITIVE  = "A+";
    case A_NEGATIVE  = "A-";
    case B_POSITIVE  = "B+";
    case B_NEGATIVE  = "B-";
    case O_POSITIVE  = "O+";
    case O_NEGATIVE  = "O-";
    case AB_POSITIVE = "AB+";
    case AB_NEGATIVE = "AB-";

    public static function toOptions(bool $asJson = false): array|bool|string
    {
        $records = array_map(fn($op) => [
            "text"  => $op->value,
            "value" => $op->value
        ], self::cases());

        if ($asJson) {
            return json_encode($records);
        }
        return $records;
    }

}
