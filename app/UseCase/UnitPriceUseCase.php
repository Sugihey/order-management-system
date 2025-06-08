<?php
namespace App\UseCase;
use App\Models\Operation;
use App\Models\UnitPrice;
use Illuminate\Support\Facades\DB;

class UnitPriceUseCase
{
    public static function getOperationsWithUnitPrices($customerId)
    {
        return Operation::leftJoin('unit_prices', function($join) use ($customerId) {
            $join->on('operations.id', '=', 'unit_prices.operation_id')
                 ->where('unit_prices.customer_id', '=', $customerId);
        })
        ->select('operations.*', 
                 'unit_prices.incoming_order_price', 
                 'unit_prices.purchase_order_price',
                 'unit_prices.id as unit_price_id')
        ->orderBy('operations.sort')
        ->get();
    }
}
