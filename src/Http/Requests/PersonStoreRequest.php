<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\HrmsPerson\Enums\BloodGroup;
use Wovosoft\HrmsPerson\Enums\Gender;
use Wovosoft\HrmsPerson\Enums\MaritalStatus;
use Wovosoft\HrmsPerson\Enums\Religion;

class PersonStoreRequest extends FormRequest
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
            "name"           => ["string"],
            "bn_name"        => ["string", "nullable"],
            "dob"            => ["nullable", "date_format:Y-m-d"],
            "gender"         => ["nullable", new Enum(Gender::class)],
            "religion"       => ["nullable", new Enum(Religion::class)],
            "marital_status" => ["nullable", new Enum(MaritalStatus::class)],
            "blood_group"    => ["nullable", new Enum(BloodGroup::class)],
        ];
    }
}
