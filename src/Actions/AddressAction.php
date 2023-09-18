<?php

namespace Wovosoft\HrmsPerson\Actions;

use Illuminate\Database\Eloquent\Model;
use Wovosoft\HrmsPerson\Models\Address;
use Wovosoft\HrmsPerson\Models\Person;

class AddressAction implements ActionInterface
{
    private Address $address;

    public function __construct(private readonly Person $person)
    {
    }

    public function create(array $data): Model|bool
    {
        $address = new Address();
        $address->forceFill($data);
        $this->person->addresses()->save($address);
        $this->address = $address;
        return true;
    }

    public function of(Address $address): static
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->address->forceFill($data)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        return $this->address->deleteOrFail();
    }
}
