<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Lib\MyUtil;

class ArtisanStoreRequest extends FormRequest
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
            'phone_no' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
    }
    public function attributes()
    {
        return [
            'name' => '名前',
            'phone_no' => '電話番号',
            'address' => '住所',
            'email' => 'メールアドレス',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => MyUtil::toStoreText($this->name),
            'phone_no' => MyUtil::toStoreText($this->phone_no),
            'address' => MyUtil::toStoreText($this->address),
            'email' => MyUtil::toStoreText($this->email),
        ]);
    }
}
