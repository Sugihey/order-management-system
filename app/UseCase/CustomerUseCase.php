<?php
namespace App\UseCase;
use App\Models\Customer;
use App\Models\BillingDestination;


class CustomerUseCase
{
    public static function getCustomersAll(){
        return Customer::orderBy('sort')->get();
    }

    public static function hasBillingDestinations($customer_id){
        return BillingDestination::query()->where('customer_id',$customer_id)->exists();
    }
}