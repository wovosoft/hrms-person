<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\HrmsPerson\Enums\Countries;
use Wovosoft\HrmsPerson\Enums\IdentificationType;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\Identification
 *
 * @property int $id
 * @property int $person_id
 * @property IdentificationType $type
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $issue_date
 * @property \Illuminate\Support\Carbon|null $expiry_date
 * @property Countries|null $issuing_country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Wovosoft\BkbHrmsCore\Models\Employee|null $employee
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @method static \Illuminate\Database\Eloquent\Builder|Identification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Identification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Identification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereIssuingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Identification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Identification extends Model
{
    use HasEmployeeTrait;

    protected $casts = [
        "type" => IdentificationType::class,
        "issue_date" => "datetime:Y-m-d",
        "expiry_date" => "datetime:Y-m-d",
        "issuing_country" => Countries::class
    ];

    use HasFactory;

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
