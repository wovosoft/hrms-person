<?php

namespace Wovosoft\HrmsPerson\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Wovosoft\HrmsPerson\Models\PersonPhoto
 *
 * @property int $id
 * @property int $person_id
 * @property int|null $uploader_id
 * @property string|null $disk
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @property-read User|null $uploader
 * @property-read string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonPhoto whereUploaderId($value)
 * @mixin \Eloquent
 */
class PersonPhoto extends Model
{
    protected $appends = [
        "url"
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function url(): Attribute
    {
        return Attribute::get(function (): string|null {
            if ($this->disk === "hrm_person" || is_null($this->disk)) {
                return asset(Storage::disk($this->disk ?? 'hrm_person')->url($this->path));
            }
            return Storage::disk($this->disk)->url($this->path);
        });
    }
}
