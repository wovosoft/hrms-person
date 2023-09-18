<?php

namespace Wovosoft\HrmsPerson\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Wovosoft\HrmsPerson\Enums\AddressType;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\Address
 *
 * @property int $id
 * @property int $person_id
 * @property AddressType $type
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property string|null $thana
 * @property string|null $bn_thana
 * @property int|null $union_id
 * @property string|null $post_office
 * @property string|null $village
 * @property string|null $bn_village
 * @property string|null $word
 * @property string|null $bn_word
 * @property string|null $road
 * @property string|null $bn_road
 * @property string|null $house
 * @property string|null $bn_house
 * @property string|null $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read District|null $district
 * @property-read Division|null $division
 * @property-read \Wovosoft\BkbHrmsCore\Models\Employee|null $employee
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @property-read Union|null $union
 * @property-read Upazila|null $upazila
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnRoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnThana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnVillage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePostOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereRoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereThana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereVillage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereWord($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    use HasFactory;
    use HasEmployeeTrait;

    protected $casts = [
        "type" => AddressType::class
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union(): BelongsTo
    {
        return $this->belongsTo(Union::class);
    }
}
