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
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'due_day' => 'required|integer|min:1|max:31',
            'properties' => 'array',
            'properties.*.name' => 'required|string|max:255',
            'properties.*.address' => 'required|string|max:255',
        ];
    }
    public function attributes()
    {
        return [
            'customer_id' => '顧客',
            'name' => '請求先名',
            'due_day' => '締め日',
            'properties' => '物件',
            'properties.*.name' => '物件名',
            'properties.*.address' => '住所',
        ];
    }
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $name = array_column($this->properties, 'name');
                $dupIndex = MyUtil::arrayDuplicateItemKeys($name);
                foreach($dupIndex as $i){
                    $validator->errors()->add(
                        'properties.'.$i.'.name',
                        '物件名が重複しています'
                    );
                    $validator->errors()->add(
                        'details','明細部にエラーがあります'
                    );
                }
                $address = array_column($this->properties, 'address');
                $dupIndex = MyUtil::arrayDuplicateItemKeys($address);
                foreach($dupIndex as $i){
                    $validator->errors()->add(
                        'properties.'.$i.'.address',
                        '住所が重複しています'
                    );
                    $validator->errors()->add(
                        'details','明細部にエラーがあります'
                    );
                }
            }
        ];
    }
    protected function prepareForValidation(): void
    {
        $properties = [];
        if($this->properties){
            foreach($this->properties as $property){
                $property['name'] = MyUtil::toStoreText($property['name']);
                $property['address'] = MyUtil::toStoreText($property['address']);
                $properties[] = $property;
            }
        }
        $this->merge([
            'customer_id' => $this->customer_id,
            'name' => MyUtil::toStoreText($this->name),
            'due_day' => $this->due_day,
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
