<?php

namespace Wovosoft\HrmsPerson\Facades;

use Illuminate\Support\Facades\Facade;

class HrmsPerson extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hrms-person';
    }
}
