<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_destination_id',
        'order_type',
        'billing_destination_name',
        'property_name',
        'property_address',
        'room_no',
        'order_date',
        'deadline',
        'is_photo_required',
        'is_call_required',
        'resident_name',
        'resident_phone_no',
        'assign_deadline',
        'jurisdiction',
        'order_no',
    ];

    protected function casts(): array
    {
        return [
            'order_date' => 'date',
            'deadline' => 'date',
            'assign_deadline' => 'date',
            'is_photo_required' => 'boolean',
            'is_call_required' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function billingDestination()
    {
        return $this->belongsTo(BillingDestination::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function generateOrderNo()
    {
        $prefix = date('Ymd');
        $lastOrder = self::where('order_no', 'like', $prefix . '%')
                        ->orderBy('order_no', 'desc')
                        ->first();
        
        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_no, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
