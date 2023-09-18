<?php

namespace Wovosoft\HrmsPerson\Actions;

use Wovosoft\HrmsPerson\Models\FamilyMember;
use Wovosoft\HrmsPerson\Models\Person;

class FamilyMemberAction implements ActionInterface
{
    private ?Person $person = null;
    private ?Person $relatedPerson = null;

    public function __construct(private readonly ?FamilyMember $familyMember = null)
    {
    }

    public static function of(?FamilyMember $familyMember = null): static
    {
        return new static($familyMember);
    }

    public function setPerson(Person $person): static
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function create(array $data): FamilyMember
    {
        if (!$this->person) {
            throw new \Exception("Person Not Initialized");
        }

        $relatedPerson = new Person();
        $relatedPerson->forceFill([
            "name"    => $data['related_person']['name'],
            "bn_name" => $data['related_person']['bn_name'],
            "dob"     => $data['related_person']['dob'],
            "gender"  => $data['related_person']['gender'],
        ])->saveOrFail();

        $this->relatedPerson = $relatedPerson;

        $familyMember = new FamilyMember();
        $familyMember->forceFill([
            'person_id'         => $this->person->id,
            'relation'          => $data['relation'],
            'related_person_id' => $relatedPerson->id
        ]);
        $familyMember->saveOrFail();
        return $familyMember;
    }

    public function setRelatedPerson(Person $person): static
    {
        $this->relatedPerson = $person;
        return $this;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(array $data): ?FamilyMember
    {
        if (!$this->person) {
            throw new \Exception("Person Not Initialized");
        }

        if (!$this->relatedPerson) {
            throw new \Exception("Related Person Not Initialized");
        }

        if (!$this->familyMember) {
            throw new \Exception("Family Member Not Initialized");
        }

        $this->familyMember
            ->forceFill([
                'relation' => $data['relation']
            ])
            ->saveOrFail();

        $this->relatedPerson
            ->forceFill([
                "name"    => $data['related_person']['name'],
                "bn_name" => $data['related_person']['bn_name'],
                "dob"     => $data['related_person']['dob'],
                "gender"  => $data['related_person']['gender'],
            ])
            ->saveOrFail();

        return $this->familyMember;
    }

    /**
     * @throws \Throwable
     */
    public function delete(): bool
    {
        $this->familyMember?->deleteOrFail();
        $this->familyMember?->relatedPerson?->deleteOrFail();
        return true;
    }
}
