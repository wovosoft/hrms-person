<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Wovosoft\HrmsPerson\Enums\WorkHistoryType;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\WorkHistory
 *
 * @property int $id
 * @property int $person_id
 * @property mixed|null $from
 * @property mixed|null $to
 * @property bool $is_departmental
 * @property int|null $prev_work_history_id
 * @property string|null $info_type
 * @property int|null $info_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property WorkHistoryType|null $type
 * @property-read \Wovosoft\BkbHrmsCore\Models\Employee|null $employee
 * @property-read Model|\Eloquent $info
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereInfoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereIsDepartmental($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory wherePrevWorkHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkHistory extends Model
{
    use HasFactory;
    use HasEmployeeTrait;

    protected $casts = [
        "from" => "immutable_datetime:Y-m-d",
        "to"   => "immutable_datetime:Y-m-d",
        "type" => WorkHistoryType::class
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (self $workHistory) {
            $workHistory->info()->delete();
        });
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * @return MorphTo<DepartmentalWorkHistory[]|NonDepartmentalWorkHistory[]>
     */
    public function info(): MorphTo
    {
        return $this->morphTo();
    }
}
