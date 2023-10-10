<?php

namespace Wovosoft\HrmsPerson\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wovosoft\HrmsPerson\Enums\BloodGroup;
use Wovosoft\HrmsPerson\Enums\Gender;
use Wovosoft\HrmsPerson\Enums\MaritalStatus;
use Wovosoft\HrmsPerson\Enums\Religion;
use Wovosoft\HrmsPerson\Models\Person;

/**
 * @extends Factory<Person>
 */
class PersonBasicFactory extends Factory
{
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $gender = Gender::cases()[random_int(0, count(Gender::cases()) - 1)];
        $religion = Religion::cases()[random_int(0, count(Religion::cases()) - 1)];
        $maritalStatus = MaritalStatus::cases()[random_int(0, count(MaritalStatus::cases()) - 1)];
        $bloodGroup = BloodGroup::cases()[random_int(0, count(BloodGroup::cases()) - 1)];

        return [
            "name"           => $this->faker->name(),
            "dob"            => $this->faker->date('Y-m-d'),
            "gender"         => $gender,
            "religion"       => $religion,
            "marital_status" => $maritalStatus,
            "blood_group"    => $bloodGroup,
        ];
    }
}
