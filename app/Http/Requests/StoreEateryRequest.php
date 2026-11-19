<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEateryRequest extends FormRequest
{
    // All pages and forms are public.
    public function authorize(): bool
    {
        return true;
    }

    // Validate a new eatery and its permit.
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:eateries,name',
            ],
            'district_id' => [
                'required',
                'exists:districts,id',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'price_range' => [
                'required',
                'in:budget,mid,splurge',
            ],
            'specialty' => [
                'nullable',
                'string',
                'max:100',
            ],
            'is_open' => [
                'boolean',
            ],
            'features' => [
                'required',
                'array',
                'min:1',
            ],
            'features.*' => [
                'exists:features,id',
            ],
            'permit_no' => [
                'required',
                'regex:/^DVO-\d{4}-\d{4,5}$/',
                'unique:permits,permit_no',
            ],
            'expires_on' => [
                'required',
                'date',
                'after:today',
            ],
        ];
    }

    // Custom messages required by the handout.
    public function messages(): array
    {
        return [
            'name.unique' =>
                'Kaon Ta Dimatulac already lists an eatery with this name.',

            'features.required' =>
                'Pick at least one feature.',

            'permit_no.regex' =>
                'Permit number must look like DVO-2026-0415.',

            'expires_on.after' =>
                'The permit must not be expired.',
        ];
    }
}
