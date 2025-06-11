<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class TaxRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'apply_date',
        'rate',
    ];

    protected function casts(): array
    {
        return [
            'apply_date' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public static function validateIsUniqueApplyDate($apply_date, $this_id=null){
        $query = TaxRate::query();
        $query->where('apply_date', $apply_date);
        if($this_id) $query->where('id','!=', $this_id);
        if($query->first()){
            throw ValidationException::withMessages([
                'apply_date' => ['同じ適用開始年月日のデータが存在します'],
            ]);
        }
    }
}
