<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'billing_destination_id' => 'required|exists:billing_destinations,id',
            'order_no' => 'required|string|max:24',
            'order_type' => 'required|string|max:45',
            'billing_destination_name' => 'required|string|max:255',
            'property_name' => 'required|string|max:255',
            'property_address' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:255',
            'order_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:order_date',
            'is_photo_required' => 'boolean',
            'is_call_required' => 'boolean',
            'resident_name' => 'required_if:is_call_required,1|nullable|string|max:255',
            'resident_phone_no' => 'required_if:is_call_required,1|nullable|string|max:255',
            'assign_deadline' => 'nullable|date',
            'jurisdiction' => 'required|string|max:45',
            'order_details' => 'required|array|min:1',
            'order_details.*.operation_id' => 'required|exists:operations,id',
            'order_details.*.artisan_id' => 'nullable|exists:artisans,id',
            'order_details.*.quantity' => 'nullable|numeric|min:0.01',
            'order_details.*.incoming_order_price' => 'nullable|numeric|min:0',
            'order_details.*.purchase_order_price' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'billing_destination_id.required' => '請求先を選択してください。',
            'billing_destination_id.exists' => '選択された請求先が存在しません。',
            'order_type.required' => '依頼区分を入力してください。',
            'order_no.required' => '発注番号を入力してください。',
            'billing_destination_name.required' => '請求先名を入力してください。',
            'property_name.required' => '物件名を入力してください。',
            'property_address.required' => '物件住所を入力してください。',
            'order_date.required' => '依頼日を入力してください。',
            'order_date.date' => '依頼日は有効な日付を入力してください。',
            'deadline.required' => '完了期日を入力してください。',
            'deadline.date' => '完了期日は有効な日付を入力してください。',
            'deadline.after_or_equal' => '完了期日は依頼日以降の日付を入力してください。',
            'resident_name.required_if' => '電話確認が必要な場合は入居者名を入力してください。',
            'resident_phone_no.required_if' => '電話確認が必要な場合は入居者TELを入力してください。',
            'jurisdiction.required' => '管轄を入力してください。',
            'order_details.required' => '作業明細を入力してください。',
            'order_details.min' => '作業明細は最低1件入力してください。',
            'order_details.*.operation_id.required' => '作業内容を選択してください。',
            'order_details.*.operation_id.exists' => '選択された作業内容が存在しません。',
            'order_details.*.artisan_id.exists' => '選択された作業担当が存在しません。',
            'order_details.*.quantity.required' => '数量を入力してください。',
            'order_details.*.quantity.numeric' => '数量は数値で入力してください。',
            'order_details.*.quantity.min' => '数量は0より大きい値を入力してください。',
            'order_details.*.incoming_order_price.required' => '受注価格を入力してください。',
            'order_details.*.incoming_order_price.numeric' => '受注価格は数値で入力してください。',
            'order_details.*.incoming_order_price.min' => '受注価格は0以上の値を入力してください。',
            'order_details.*.purchase_order_price.required' => '発注価格を入力してください。',
            'order_details.*.purchase_order_price.numeric' => '発注価格は数値で入力してください。',
            'order_details.*.purchase_order_price.min' => '発注価格は0以上の値を入力してください。',
        ];
    }
}
