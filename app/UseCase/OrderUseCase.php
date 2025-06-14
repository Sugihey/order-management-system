<?php

namespace App\UseCase;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderUseCase
{
    public static function createOrder($request)
    {
        return DB::transaction(function () use ($request) {
            $orderNo = Order::generateOrderNo();
            
            $order = Order::create([
                'title' => $request->title,
                'billing_destination_id' => $request->billing_destination_id,
                'order_type' => $request->order_type,
                'priority' => $request->priority,
                'billing_destination_name' => $request->billing_destination_name,
                'property_name' => $request->property_name,
                'property_address' => $request->property_address,
                'room_no' => $request->room_no ?: null,
                'order_date' => $request->order_date,
                'deadline' => $request->deadline,
                'is_photo_required' => $request->boolean('is_photo_required'),
                'is_call_required' => $request->boolean('is_call_required'),
                'resident_name' => $request->resident_name ?: null,
                'resident_phone_no' => $request->resident_phone_no ?: null,
                'assign_deadline' => $request->assign_deadline ?: null,
                'jurisdiction' => $request->jurisdiction,
                'order_no' => $orderNo,
            ]);

            foreach ($request->order_details as $index => $detailData) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'index' => $index + 1,
                    'operation_id' => $detailData['operation_id'],
                    'artisan_id' => $detailData['artisan_id'] ?: null,
                    'quantity' => $detailData['quantity'] ?: 0,
                    'incoming_order_price' => $detailData['incoming_order_price'] ?: 0,
                    'purchase_order_price' => $detailData['purchase_order_price'] ?: 0,
                ]);
            }

            return $order;
        });
    }
}
