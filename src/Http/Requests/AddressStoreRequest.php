<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Wovosoft\HrmsPerson\Enums\AddressType;

class AddressStoreRequest extends FormRequest
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
            "type"        => [new Enum(AddressType::class)],
            "division_id" => [
                Rule::exists(Division::class, 'id')
            ],
            "district_id" => [
                Rule::exists(District::class, 'id')
            ],
            "upazila_id"  => [
                Rule::exists(Upazila::class, 'id')
            ],
            "union_id"    => [
                Rule::exists(Union::class, 'id')
            ],
            "village"     => ["string", "nullable"],
            "word"        => ["string", "nullable"],
            "road"        => ["string", "nullable"],
            "phone"       => ["string", "nullable"],
            "email"       => ["email", "nullable"],
        ];
    }
}
