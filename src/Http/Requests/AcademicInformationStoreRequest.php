<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\BdAcademicComponents\Models\AcademicBoard;
use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;
use Wovosoft\BdAcademicComponents\Models\University;
use Wovosoft\HrmsPerson\Enums\Exam;
use Wovosoft\HrmsPerson\Enums\ResultType;

class AcademicInformationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "university_id"          => [
                Rule::exists(University::class, 'id')
            ],
            "exam"                   => [new Enum(Exam::class)],
            "result_type"            => [new Enum(ResultType::class)],
            "result"                 => ["numeric", "gt:0", "lt:10"],
            "passing_year"           => ["digits:4"],
            "session"                => ["nullable"],
            "academic_board_id"      => [
                "nullable",
                Rule::exists(AcademicBoard::class, 'id')
            ],
            "academic_discipline_id" => [
                "nullable",
                Rule::exists(AcademicDiscipline::class, 'id')
            ],
        ];
    }
}
