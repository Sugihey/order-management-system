<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'billing_destination_id',
        'name',
        'address',
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

    public function billingDestination()
    {
        return $this->belongsTo(BillingDestination::class);
    }

    public static function getBillingDestinationProperties($billingDestination_id)
    {
        return Property::where('billing_destination_id',$billingDestination_id)->get();
    }
    public static function validateIsUniqueInBillingDestination($properties, $billingDestination_id=null) {
        //Has duplicate properties in properties param
//         $query = SELF::query();
//         $query->where('billing_destination_id', $billingDestination_id);
//         $query->where('name', $name);
// //        if($this_id) $query->where('id','!=', $this_id);
//         return !$query->first();
    }
}
