<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class Operation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'unit',
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

    public static function validateIsUnique($name, $this_id=null){
        $query = Operation::query();
        $query->where('name', $name);
        if($this_id) $query->where('id','!=', $this_id);
        if($query->first()){
            throw ValidationException::withMessages([
                'name' => ['同じ名前の作業が存在します'],
            ]);
        }
    }

    public static function createOrRecover($attributes){
        DB::transaction(function() use($attributes){
            extract($attributes);
            $exist = Operation::withTrashed()->where('name',$name)->first();
            if(!$exist){
                return Operation::create([
                    'name' => $name,
                    'unit' => $unit,
                    'sort' => 0,
                ]);
            }elseif($exist && $exist->trashed()){
                $exist->restore();
                $exist->update([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);
                return $exist;
            }
            throw ValidationException::withMessages([
                'name' => ['同じ名前の作業が存在します'],
            ]);
        });
    }
}
