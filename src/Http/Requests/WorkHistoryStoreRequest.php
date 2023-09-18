<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use App\Models\Office;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wovosoft\BkbHrmsCore\Models\Designation;

class WorkHistoryStoreRequest extends FormRequest
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
        $rules = [
            "from"            => ["date_format:Y-m-d", "nullable"],
            "to"              => ["date_format:Y-m-d", "nullable"],
            "is_departmental" => ["boolean", "nullable"],
        ];

        if ($this->input('is_departmental')) {
            $rules = [
                ...$rules,
                "info.office_id"      => [
                    "required",
                    Rule::exists(Office::class, 'id')
                ],
                "info.designation_id" => [
                    Rule::exists(Designation::class, 'id')
                ],
                "info.comment"        => [
                    "string",
                    "nullable"
                ]
            ];
        } else {
            $rules = [
                ...$rules,
                "info.institution_id" => [
                    "numeric"//temporary
                ],
                "info.designation"    => [
                    "string",
                    "nullable"
                ],
                "info.posting_office" => [
                    "string",
                    "nullable"
                ],
                "info.comment"        => [
                    "string",
                    "nullable"
                ]
            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            "info.office_id"      => [
                "required" => "Office must be selected",
                "exists"   => "Selected office doesn't exist"
            ],
            "info.designation_id" => [
                "required" => "Office must be selected",
                "exists"   => "Selected office doesn't exist"
            ]
        ];
    }
}


