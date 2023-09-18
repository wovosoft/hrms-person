<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\HrmsPerson\Enums\Countries;
use Wovosoft\HrmsPerson\Enums\IdentificationType;

class IdentificationStoreRequest extends FormRequest
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
            "type"            => [new Enum(IdentificationType::class)],
            "number"          => ["required"],
            "issue_date"      => ["date_format:Y-m-d", "nullable"],
            "expiry_date"     => [
                "date_format:Y-m-d",
                //add min while issue_date exists rule
                "nullable"
            ],
            "issuing_country" => [new Enum(Countries::class)]
        ];
    }
}
