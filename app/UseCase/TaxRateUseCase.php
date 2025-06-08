<?php
namespace App\UseCase;
use App\Models\TaxRate;


class TaxRateUseCase
{
    public static function getTaxRatesAll(){
        return TaxRate::orderBy('apply_date', 'desc')->get();
    }
}
