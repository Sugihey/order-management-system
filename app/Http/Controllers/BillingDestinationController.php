<?php

namespace App\Http\Controllers;

use App\UseCase\BillingDestinationUseCase;
use App\Models\BillingDestination;
use App\Models\Customer;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingDestinationController extends Controller
{
    public function index()
    {
        $billingDestinations = BillingDestinationUseCase::getBillingDestinationsAll();
        return view('billing_destinations.index', compact('billingDestinations'));
    }

    public function create()
    {
        $customers = BillingDestinationUseCase::getCustomersForSelection();
        return view('billing_destinations.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'due_day' => 'required|integer|min:1|max:31',
            'properties' => 'array',
            'properties.*.name' => 'required|string|max:255',
            'properties.*.address' => 'required|string|max:255',
        ]);

        $billingDestination = BillingDestination::create([
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'due_day' => $request->due_day,
            'sort' => 0,
        ]);

        if ($request->properties) {
            foreach ($request->properties as $index => $property) {
                $billingDestination->properties()->create([
                    'name' => $property['name'],
                    'address' => $property['address'],
                    'sort' => $index + 1,
                ]);
            }
        }

        return redirect()->route('billing_destinations.index')->with('success', '請求先が登録されました。');
    }

    public function show(BillingDestination $billingDestination)
    {
        $billingDestination->load('customer', 'properties');
        return view('billing_destinations.show', compact('billingDestination'));
    }

    public function edit(BillingDestination $billingDestination)
    {
        $customers = BillingDestinationUseCase::getCustomersForSelection();
        $billingDestination->load('customer', 'properties');
        return view('billing_destinations.edit', compact('billingDestination', 'customers'));
    }

    public function update(Request $request, BillingDestination $billingDestination)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'due_day' => 'required|integer|min:1|max:31',
            'properties' => 'array',
            'properties.*.name' => 'required|string|max:255',
            'properties.*.address' => 'required|string|max:255',
        ]);

        try{
            DB::transaction(function() use($billingDestination, $request){
                $billingDestination->update([
                    'customer_id' => $request->customer_id,
                    'name' => $request->name,
                    'due_day' => $request->due_day,
                ]);
        
                //BulkUpsert
                // 1.SoftDelete all
                // 2.Restore items if it's still remains
                // 3.Upsert with input data
                $billingDestination->properties()->delete();
                if ($request->properties) {
                    foreach ($request->properties as $index => $property) {
                        $propertyData = [
                            'name' => $property['name'],
                            'address' => $property['address'],
                            'sort' => $index + 1,
                        ];
                        if(isset($property['id'])){
                            $propertyData['id'] = $property['id'];
                            Property::onlyTrashed()->where('id','=',$property['id'])->restore();
                        }
                        $billingDestination->properties()->upsert($propertyData,['id'],['name','address','sort']);
                    }
                }
            });
        } catch(\Exception $e) {
            return redirect()->route('billing_destinations.edit', $billingDestination)->with('error', '請求先の更新に失敗しました。');
        }

        return redirect()->route('billing_destinations.index')->with('success', '請求先情報が更新されました。');
    }

    public function destroy(BillingDestination $billingDestination)
    {
        $billingDestination->delete();
        return redirect()->route('billing_destinations.index')->with('success', '請求先が削除されました。');
    }
}
