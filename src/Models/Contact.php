<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\HrmsPerson\Enums\ContactType;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\Contact
 *
 * @property int $id
 * @property int $person_id
 * @property ContactType $type
 * @property string $content
 * @property string|null $label
 * @property string|null $company
 * @property string|null $department
 * @property string|null $relation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;
    use HasEmployeeTrait;

    protected $casts = [
        "type" => ContactType::class
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
