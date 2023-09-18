<?php

namespace Wovosoft\HrmsPerson\Actions;

use Exception;
use Illuminate\Support\Facades\Storage;
use Wovosoft\BkbHrmsCore\Models\Employee;
use Wovosoft\HrmsPerson\Models\Person;
use Wovosoft\HrmsPerson\Models\PersonPhoto;

class PhotosAction implements ActionInterface
{
    private ?PersonPhoto $photo = null;

    public function __construct(private readonly Person $person)
    {
    }

    public static function instance(Person $person): static
    {
        return new static($person);
    }

    public function of(PersonPhoto $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function create(array $data): static
    {
        $photo = new PersonPhoto();
        $photo->forceFill($data);
        $this->person->photos()->save($photo);
        $this->photo = $photo;
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function setProfilePhoto(): static
    {
        if (!isset($this->photo)) {
            throw new Exception("Photo is net set");
        }

        if ($this->person->person_photo_id===$this->person->id){
            throw new Exception("Profile is already set");
        }

        $this->person->person_photo_id = $this->photo->id;
        $this->person->saveOrFail();
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function unsetProfilePhoto(): static
    {
        if (!isset($this->photo)) {
            throw new Exception("Photo is net set");
        }

        $this->person->person_photo_id = null;
        $this->person->saveOrFail();
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data): static
    {
        if (!isset($this->photo)) {
            throw new Exception("Photo is net set");
        }

        $this->photo->forceFill($data)->saveOrFail();
        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function delete(): static
    {
        if (!isset($this->photo)) {
            throw new Exception("Photo is net set");
        }

        $this->photo->deleteOrFail();
        Storage::disk('hrm_person')->delete($this->photo->path);
        return $this;
    }
}
