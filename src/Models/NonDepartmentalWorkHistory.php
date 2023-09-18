<?php

namespace Wovosoft\HrmsPerson\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Wovosoft\HrmsPerson\Models\NonDepartmentalWorkHistory
 *
 * @property int $id
 * @property int $institution_id
 * @property string $designation
 * @property string $posting_office
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Wovosoft\HrmsPerson\Models\WorkHistory|null $workHistory
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory wherePostingOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NonDepartmentalWorkHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NonDepartmentalWorkHistory extends Model
{
    use HasFactory;

    public function workHistory(): MorphOne
    {
        return $this->morphOne(WorkHistory::class, 'info');
    }
}
