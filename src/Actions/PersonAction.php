<?php

namespace Wovosoft\HrmsPerson\Actions;


use Wovosoft\HrmsPerson\Models\FamilyMember;
use Wovosoft\HrmsPerson\Models\Person;

class PersonAction implements ActionInterface
{

    public function __construct(private ?Person $person = null)
    {
    }

    public static function of(?Person $person = null): static
    {
        return new static(person: $person);
    }

    public function setPerson(Person $person): static
    {
        $this->person = $person;
        return $this;
    }

    public function contacts(): ContactAction
    {
        return new ContactAction(person: $this->person);
    }

    public function addresses(): AddressAction
    {
        return new AddressAction(person: $this->person);
    }

    public function familyMembers(?FamilyMember $familyMember = null): FamilyMemberAction
    {
        $action = new FamilyMemberAction(familyMember: $familyMember);
        $action->setPerson($this->person);

        return $action;
    }

    public function identifications(): IdentificationsAction
    {
        return new IdentificationsAction(person: $this->person);
    }

    public function workHistories(): WorkHistoriesAction
    {
        return new WorkHistoriesAction(person: $this->person);
    }

    public function academicInformation(): AcademicInformationAction
    {
        return AcademicInformationAction::instance(person: $this->person);
    }

    public function photos(): PhotosAction
    {
        return PhotosAction::instance(person: $this->person);
    }

    /**
     * @throws \Throwable
     */
    public function create(array $data): Person
    {
        $person = new Person;
        $person->forceFill($data)->saveOrFail();

        $this->person = $person;
        return $person;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): bool
    {
        return $this->person->forceFill($data)->saveOrFail();
    }

    /**
     * @throws \Throwable
     */
    public function delete(): ?bool
    {
        return $this->person->deleteOrFail();
    }
}

