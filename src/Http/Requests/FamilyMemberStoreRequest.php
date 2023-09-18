<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\HrmsPerson\Enums\Gender;
use Wovosoft\HrmsPerson\Enums\Relation;

class FamilyMemberStoreRequest extends FormRequest
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
            "relation"               => [new Enum(Relation::class)],
            "related_person.name"    => ["string"],
            "related_person.bn_name" => ["string", "nullable"],
            "related_person.dob"     => ["date_format:Y-m-d", "nullable"],
            "related_person.gender"  => [new Enum(Gender::class), "nullable"],
        ];
    }
}
