<?php

namespace Wovosoft\HrmsPerson\Traits;

use Wovosoft\BkbHrmsCore\Models\Employee;
use Wovosoft\HrmsPerson\Models\Person;

trait HasEmployeeTrait
{
    public function employee()
    {
        return $this->hasOneThrough(
            Employee::class,
            Person::class,
            'id',
            'person_id',
            'person_id',
            'id'
        );
    }
}
