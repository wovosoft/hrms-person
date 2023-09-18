<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Wovosoft\HrmsPerson\Enums\BloodGroup;
use Wovosoft\HrmsPerson\Enums\Gender;
use Wovosoft\HrmsPerson\Enums\MaritalStatus;
use Wovosoft\HrmsPerson\Enums\Religion;

/**
 * Wovosoft\HrmsPerson\Models\Person
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property mixed|null $dob
 * @property Gender|null $gender
 * @property Religion|null $religion
 * @property MaritalStatus|null $marital_status
 * @property BloodGroup|null $blood_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $person_photo_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\AcademicInformation> $academicInformation
 * @property-read int|null $academic_information_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BankingDiploma> $bankingDiplomas
 * @property-read int|null $banking_diplomas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read Employee|null $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Person> $familyMemberPersons
 * @property-read int|null $family_member_persons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\FamilyMember> $familyMembers
 * @property-read int|null $family_members_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\Identification> $identifications
 * @property-read int|null $identifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\PersonPhoto> $photos
 * @property-read int|null $photos_count
 * @property-read \Wovosoft\HrmsPerson\Models\PersonPhoto|null $profilePhoto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Wovosoft\HrmsPerson\Models\WorkHistory> $workHistories
 * @property-read int|null $work_histories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePersonPhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Person extends Model
{
    use HasFactory;

    protected $casts = [
        "dob"            => "immutable_datetime:Y-m-d",
        "gender"         => Gender::class,
        "religion"       => Religion::class,
        "marital_status" => MaritalStatus::class,
        "blood_group"    => BloodGroup::class
    ];

    public function profilePhoto(): BelongsTo
    {
        return $this->belongsTo(PersonPhoto::class, 'person_photo_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PersonPhoto::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function familyMemberPersons(): HasManyThrough
    {
        return $this->hasManyThrough(
            Person::class,
            FamilyMember::class,
            "person_id",
            "id",
            "id",
            "related_person_id"
        );
    }

    public function familyMembers(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function identifications(): HasMany
    {
        return $this->hasMany(Identification::class);
    }

    public function academicInformation(): HasMany
    {
        return $this->hasMany(AcademicInformation::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function workHistories(): HasMany
    {
        return $this->hasMany(WorkHistory::class);
    }
}
