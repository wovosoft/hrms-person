<?php

namespace Wovosoft\HrmsPerson\Actions;

use Wovosoft\HrmsPerson\Models\AcademicInformation;
use Wovosoft\HrmsPerson\Models\Person;

class AcademicInformationAction implements ActionInterface
{
    private AcademicInformation $academicInformation;

    public function __construct(private readonly Person $person)
    {
    }

    public static function instance(Person $person): static
    {
        return new static($person);
    }

    /**
     * @throws \Throwable
     */
    public function create(array $data): bool
    {
        $academicInformation = new AcademicInformation();
        $academicInformation->forceFill($data);
        $this->person->academicInformation()->save($academicInformation);
        $this->academicInformation = $academicInformation;
        return true;
    }

    public function of(AcademicInformation $academicInformation): static
    {
        $this->academicInformation = $academicInformation;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->academicInformation->forceFill($data)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        return $this->academicInformation->deleteOrFail();
    }
}
