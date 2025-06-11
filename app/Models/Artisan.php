<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class Artisan extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'phone_no',
        'address',
        'email',
        'password',
        'email_verified_at',
        'email_verification_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'email_verification_token' => null,
        ])->save();
    }

    public function generateEmailVerificationToken()
    {
        $this->email_verification_token = Str::random(60);
        $this->save();
        return $this->email_verification_token;
    }

    public static function validateIsUniqueEmail($email, $this_id=null)
    {
        $query = Artisan::query();
        $query->where('email', $email);
        if($this_id) $query->where('id','!=', $this_id);
        if($query->first()){
            throw ValidationException::withMessages([
                'email' => ['同じメールアドレスの職人が存在します'],
            ]);
        }
    }
    public static function createOrRecover($attributes){
        DB::transaction(function() use($attributes){
            extract($attributes);
            $exist = Artisan::withTrashed()->where('email',$email)->first();
            if(!$exist){
                return Artisan::create([
                    'name' => $name,
                    'phone_no' => $phone_no,
                    'address' => $address,
                    'email' => $email,
                    'password' => $password,
                    'email_verified_at' => now(),
                ]);
            }elseif($exist && $exist->trashed()){
                $exist->restore();
                $exist->update([
                    'name' => $name,
                    'phone_no' => $phone_no,
                    'address' => $address,
                    'email' => $email,
                    'password' => $password,
                    'email_verified_at' => now(),
                ]);
                return $exist;
            }
            throw ValidationException::withMessages([
                'email' => ['同じメールアドレスの職人が存在します'],
            ]);
        });
    }
}
