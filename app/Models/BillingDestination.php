<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($billingDestination) {
            $billingDestination->properties()->delete();
        });
    }
    public static function validateIsUniqueInCustomer($customer_id, $name ,$this_id=null)
    {
        $query = BillingDestination::query();
        $query->where('customer_id', $customer_id);
        $query->where('name', $name);
        if($this_id) $query->where('id','!=', $this_id);
        if($query->first()){
            throw ValidationException::withMessages([
                'name' => ['この顧客には既に同じ名称の請求先が存在します'],
            ]);
        }
    }
    public static function getOthersBillingDestination()
    {
        return BillingDestination::query()->where('name','その他')->with('customer')->first();
    }
}
