<?php

namespace Wovosoft\HrmsPerson\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Wovosoft\HrmsPerson\Enums\ContactType;

class ContactStoreRequest extends FormRequest
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
            "type"       => [new Enum(ContactType::class)],
            "label"      => ["nullable", "string"],
            "content"    => ["nullable", "string"],
            "company"    => ["nullable", "string"],
            "department" => ["nullable", "string"],
            "relation"   => ["nullable", "string"],
        ];
    }
}
