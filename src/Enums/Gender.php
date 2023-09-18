<?php

namespace Wovosoft\HrmsPerson\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum Gender: string
{
    use HasEnumExtensions;

    case Male   = "m";
    case Female = "f";
    case Others = "o";

    public function isMale(): bool
    {
        return $this->value === 'm';
    }

    public function isFemale(): bool
    {
        return $this->value === 'f';
    }

    public function isOther(): bool
    {
        return $this->value === 'o' || !$this->value;
    }
}
