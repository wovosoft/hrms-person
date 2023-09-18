<?php

namespace Wovosoft\HrmsPerson;

use Wovosoft\HrmsPerson\Actions\PersonAction;

class HrmsPerson
{
    public function persons(): PersonAction
    {
        return new PersonAction;
    }
}

