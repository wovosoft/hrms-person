<?php

namespace Wovosoft\HrmsPerson\Actions;

use Wovosoft\HrmsPerson\Models\Identification;
use Wovosoft\HrmsPerson\Models\Person;

class IdentificationsAction implements ActionInterface
{
    private Identification $identification;

    public function __construct(private readonly Person $person)
    {
    }

    public function create(array $data): bool
    {
        $identification = new Identification();
        $identification->forceFill($data);
        $this->person->identifications()->save($identification);
        $this->identification = $identification;
        return true;
    }

    public function of(Identification $identification): static
    {
        $this->identification = $identification;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->identification->forceFill($data)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        return $this->identification->deleteOrFail();
    }
}
