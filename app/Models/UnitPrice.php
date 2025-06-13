<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'operation_id',
        'incoming_order_price',
        'purchase_order_price',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
}
