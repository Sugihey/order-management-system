<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'index',
        'operation_id',
        'artisan_id',
        'quantity',
        'incoming_order_price',
        'purchase_order_price',
        'completion_date',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'incoming_order_price' => 'decimal:2',
            'purchase_order_price' => 'decimal:2',
            'completion_date' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
