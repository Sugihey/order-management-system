<?php

namespace App\UseCase;

use App\Models\BillingDestination;
use App\Models\Customer;

class BillingDestinationUseCase
{
    public static function getBillingDestinationsAll()
    {
        return BillingDestination::with('customer')->orderBy('sort')->get();
    }

    public static function getCustomersForSelection()
    {
        return Customer::orderBy('sort')->get();
    }
}
