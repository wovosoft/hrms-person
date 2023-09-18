<?php

namespace Wovosoft\HrmsPerson\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\BdAcademicComponents\Models\AcademicBoard;
use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;
use Wovosoft\BdAcademicComponents\Models\University;
use Wovosoft\HrmsPerson\Enums\Exam;
use Wovosoft\HrmsPerson\Enums\ResultType;
use Wovosoft\HrmsPerson\Traits\HasEmployeeTrait;

/**
 * Wovosoft\HrmsPerson\Models\AcademicInformation
 *
 * @property int $id
 * @property int $person_id
 * @property int|null $university_id
 * @property Exam $exam
 * @property ResultType|null $result_type
 * @property float|null $result
 * @property int|null $passing_year
 * @property string|null $session
 * @property int|null $academic_board_id
 * @property int|null $academic_discipline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read AcademicBoard|null $academicBoard
 * @property-read AcademicDiscipline|null $academicDiscipline
 * @property-read \Wovosoft\BkbHrmsCore\Models\Employee|null $employee
 * @property-read \Wovosoft\HrmsPerson\Models\Person $person
 * @property-read University|null $university
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereAcademicBoardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereAcademicDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereExam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation wherePassingYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereResultType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicInformation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicInformation extends Model
{
    use HasFactory;
    use HasEmployeeTrait;

    protected $casts = [
        "exam" => Exam::class,
        "result_type" => ResultType::class,
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function academicBoard(): BelongsTo
    {
        return $this->belongsTo(AcademicBoard::class);
    }

    public function academicDiscipline(): BelongsTo
    {
        return $this->belongsTo(AcademicDiscipline::class);
    }

}
