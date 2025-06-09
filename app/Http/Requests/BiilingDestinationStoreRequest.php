<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Lib\MyUtil;

class BiilingDestinationStoreRequest extends FormRequest
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
            'billing_destinations.customer_id' => 'required|exists:customers,id',
            'billing_destinations.name' => 'required|unique:billing_destinations,name|string|max:255',
            'billing_destinations.due_day' => 'required|integer|min:1|max:31',
            'properties' => 'array',
            'properties.*.name' => 'required|string|max:255',
            'properties.*.address' => 'required|string|max:255',
        ];
    }
    protected function prepareForValidation(): void
    {
        $billingDestinations = [
            'customer_id' => $this->billing_destinations['customer_id'],
            'name' => MyUtil::toStoreText($this->billing_destinations['name']),
            'due_day' => $this->billing_destinations['due_day'],
        ];
        $properties = [];
        foreach($this->properties as $property){
            $properties[] = [
                'name' => MyUtil::toStoreText($property['name']),
                'address' => MyUtil::toStoreText($property['address']),
            ];
        }
        $this->merge([
            'billing_destinations' => $billingDestinations,
            'properties' => $properties,
        ]);
    }

    protected function failedValidation(Validator $validator): void
    {
        // 加工後のデータを使ってリクエストオブジェクトを書き換える
        request()->merge($this->input());

        // 基底クラスの処理を実行
        parent::failedValidation($validator);
    }
}
