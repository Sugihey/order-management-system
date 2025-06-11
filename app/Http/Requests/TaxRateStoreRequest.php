<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'apply_date' => 'required|date',
            'rate' => 'required|integer|min:0|max:100',
        ];
    }
    public function attributes()
    {
        return [
            'apply_date' => '適用年月日',
            'rate' => '税率',
        ];
    }
}
