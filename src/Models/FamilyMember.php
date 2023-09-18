<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Wovosoft\HrmsPerson\Enums\Relation;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\FamilyMember
 *
 * @property int $id
 * @property int $person_id
 * @property Relation $relation
 * @property int $related_person_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Wovosoft\BkbHrmsCore\Models\Employee|null $employee
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @property-read \Wovosoft\HrmsPerson\Models\Person $relatedPerson
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember whereRelatedPersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FamilyMember extends Model
{
    use HasFactory;
    use HasEmployeeTrait;

    protected $casts = [
        "relation" => Relation::class
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function relatedPerson(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'related_person_id');
    }
}
