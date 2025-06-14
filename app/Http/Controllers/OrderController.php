<?php

namespace App\Http\Controllers;

use App\UseCase\OrderUseCase;
use App\Models\BillingDestination;
use App\Models\Property;
use App\Models\Operation;
use App\Models\Artisan;
use App\Models\UnitPrice;
use App\Models\Customer;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;
use App\Enums\OrderType;
use App\Enums\Priority;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $priorities = Priority::cases();
        $orderTypes = OrderType::cases();
        $details = $request->old('order_details');
        $detailRow = isset($details) ? count($details) : 1;
        $others = BillingDestination::getOthersBillingDestination();
        if(!$others){
            return redirect()->route('dashboard')->with('error', '請求先マスターに「その他」を登録してください。');
        }
        if(!$others->customer){
            return redirect()->route('dashboard')->with('error', '顧客マスターに「その他」を登録してください。');
        }

        return view('orders.create', compact('priorities', 'orderTypes','detailRow','others'));
    }

    public function store(OrderStoreRequest $request)
    {
        try {
            $order = OrderUseCase::createOrder($request);
            return redirect()->route('dashboard')->with('success', '受注書が登録されました。発注書番号: ' . $order->order_no);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '受注書の登録に失敗しました。' . $e->getMessage())->withInput();
        }
    }

    public function searchBillingDestinations(Request $request)
    {
        $query = $request->get('q', '');
        
        $billingDestinations = BillingDestination::with('customer')
            ->where('name', 'like', '%' . $query . '%')
            ->orderBy('sort')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $billingDestinations->map(function ($bd) {
                return [
                    'id' => $bd->id,
                    'name' => $bd->name,
                    'customer_id' => $bd->customer_id,
                    'customer_name' => $bd->customer->name,
                ];
            })
        ]);
    }

    public function getPropertiesByBillingDestination($billingDestinationId)
    {
        $properties = Property::where('billing_destination_id', $billingDestinationId)
            ->orderBy('sort')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $properties->map(function ($property) {
                return [
                    'id' => $property->id,
                    'name' => $property->name,
                    'address' => $property->address,
                ];
            })
        ]);
    }

    public function searchOperations(Request $request)
    {
        $query = $request->get('q', '');
        
        $operations = Operation::where('name', 'like', '%' . $query . '%')
            ->orderBy('sort')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $operations->map(function ($operation) {
                return [
                    'id' => $operation->id,
                    'name' => $operation->name,
                    'unit' => $operation->unit,
                ];
            })
        ]);
    }

    public function searchArtisans(Request $request)
    {
        $query = $request->get('q', '');
        
        $artisans = Artisan::where('name', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $artisans->map(function ($artisan) {
                return [
                    'id' => $artisan->id,
                    'name' => $artisan->name,
                ];
            })
        ]);
    }

    public function getUnitPricesByCustomer($customerId)
    {
        $unitPrices = UnitPrice::with('operation')
            ->where('customer_id', $customerId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $unitPrices->map(function ($unitPrice) {
                return [
                    'operation_id' => $unitPrice->operation_id,
                    'operation_name' => $unitPrice->operation->name,
                    'incoming_order_price' => $unitPrice->incoming_order_price,
                    'purchase_order_price' => $unitPrice->purchase_order_price,
                ];
            })
        ]);
    }
}
