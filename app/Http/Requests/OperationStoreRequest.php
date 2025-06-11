<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Lib\MyUtil;

class OperationStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:3',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '作業名',
            'unit' => '単位',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => MyUtil::toStoreText($this->name),
            'unit' => MyUtil::toStoreText($this->unit),
        ]);
    }
}