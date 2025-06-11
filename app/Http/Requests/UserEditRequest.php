<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Lib\MyUtil;

class UserEditRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => MyUtil::toStoreText($this->name),
            'email' => MyUtil::toStoreText($this->email),
            'password' => MyUtil::toStoreText($this->password),
        ]);
    }

}
