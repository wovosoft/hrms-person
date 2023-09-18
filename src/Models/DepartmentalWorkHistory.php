<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Wovosoft\BkbHrmsCore\Models\Designation;
use Wovosoft\BkbOffices\Models\Office;

/**
 * Wovosoft\HrmsPerson\Models\DepartmentalWorkHistory
 *
 * @property int $id
 * @property int|null $office_id
 * @property int|null $designation_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Designation|null $designation
 * @property-read Office|null $office
 * @property-read \Wovosoft\HrmsPerson\Models\WorkHistory|null $workHistory
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereDesignationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentalWorkHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DepartmentalWorkHistory extends Model
{
    use HasFactory;

    protected $with = [
        "office:id,name,bn_name,code",
        "designation:id,name,bn_name,code"
    ];


    public function workHistory(): MorphOne
    {
        return $this->morphOne(WorkHistory::class, 'info');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }
}
