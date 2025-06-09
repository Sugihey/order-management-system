<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingDestination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'due_day',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class)->orderBy('sort');
    }

    public static function isUniqueInCustomer($customer_id, $name ,$this_id=null)
    {
        $query = BillingDestination::query();
        $query->where('customer_id', $customer_id);
        $query->where('name', $name);
        if($this_id) $query->where('id','!=', $this_id);
        return !$query->first();
    }
}
