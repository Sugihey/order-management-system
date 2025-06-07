<?php
namespace App\UseCase;
use App\Models\Customer;


class CustomerUseCase
{
    public static function getCustomersAll(){
        return Customer::orderBy('sort')->get();
    }
}