<?php

namespace Wovosoft\HrmsPerson\Actions;

use Illuminate\Database\Eloquent\Model;
use Wovosoft\HrmsPerson\Models\Contact;
use Wovosoft\HrmsPerson\Models\Person;

class ContactAction implements ActionInterface
{
    private Contact $contact;

    public function __construct(private readonly Person $person)
    {
    }

    public function create(array $data): Model|bool
    {
        $contact = new Contact;
        $contact->forceFill($data);
        $this->person->contacts()->save($contact);
        $this->contact = $contact;
        return $contact;
    }

    public function of(Contact $contact): static
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->contact->forceFill($data)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        return $this->contact->deleteOrFail();
    }
}
