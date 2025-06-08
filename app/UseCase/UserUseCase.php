<?php
namespace App\UseCase;
use App\Models\User;


class UserUseCase
{
    public static function getUsersAll(){
        return User::orderBy('created_at', 'desc')->get();
    }
}
