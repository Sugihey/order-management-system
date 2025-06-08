<?php

namespace App\Http\Controllers;

use App\UseCase\CustomerUseCase;
use App\UseCase\UnitPriceUseCase;
use App\Models\UnitPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitPriceController extends Controller
{
    public function index()
    {
        $customers = CustomerUseCase::getCustomersAll();
        return view('unit_prices.index', compact('customers'));
    }

    public function getOperationsByCustomer(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        $operations = UnitPriceUseCase::getOperationsWithUnitPrices($request->customer_id);
        
        return response()->json([
            'success' => true,
            'operations' => $operations
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'unit_prices' => 'required|array',
            'unit_prices.*.operation_id' => 'required|exists:operations,id',
            'unit_prices.*.incoming_order_price' => 'required|numeric|min:0',
            'unit_prices.*.purchase_order_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            UnitPrice::where('customer_id', $request->customer_id)->delete();

            foreach ($request->unit_prices as $unitPriceData) {
                UnitPrice::create([
                    'customer_id' => $request->customer_id,
                    'operation_id' => $unitPriceData['operation_id'],
                    'incoming_order_price' => $unitPriceData['incoming_order_price'],
                    'purchase_order_price' => $unitPriceData['purchase_order_price'],
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => '作業単価が保存されました。'
        ]);
    }
}
