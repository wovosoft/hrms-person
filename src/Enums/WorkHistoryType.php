<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum WorkHistoryType: string
{
    use HasEnumExtensions;

    case Transfer    = "transfer";
    case Promotion   = "promotion";
    case Increment   = "increment";
    case Demotion    = "demotion";
    case Resignation = "resignation";
    case Suspension  = "suspension";

    public static function fromRaw(?string $jobType = null): WorkHistoryType
    {
        return match ($jobType) {
            "Increment" => self::Increment,
            "Promotion" => self::Promotion,
            default     => self::Transfer
        };
    }
}
