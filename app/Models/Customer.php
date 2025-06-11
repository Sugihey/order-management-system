<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
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

    public function billingDestinations()
    {
        return $this->hasMany(BillingDestination::class)->orderBy('sort');
    }

    public function validateIsUnique($name ,$this_id=null){
        $query = Customer::query();
        $query->where('name', $name);
        if($this_id) $query->where('id','!=', $this_id);
        if($query->first()){
            throw ValidationException::withMessages([
                'name' => ['同じ名前の顧客が存在します'],
            ]);
        }
    }
}
