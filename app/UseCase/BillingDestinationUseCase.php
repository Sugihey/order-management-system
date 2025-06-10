<?php

namespace App\UseCase;

use App\Models\BillingDestination;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use Illuminate\Validation\ValidationException;

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

    public static function storeBillingDestinationAndProperties($request, $billingDestination=null)
    {
        DB::transaction(function() use($request, $billingDestination){
            //Upsert BillingDestination
            if($billingDestination){
                //update
                $billingDestination->update([
                    'customer_id' => $request->customer_id,
                    'name' => $request->name,
                    'due_day' => $request->due_day
                ]);
            }else{
                //create
                $billingDestination = BillingDestination::create([
                    'customer_id' => $request->customer_id,
                    'name' => $request->name,
                    'due_day' => $request->due_day,
                    'sort' => $request->sort ?? 0,
                ]);
            }

            //BulkUpsert properties
            // 1.Get exist properties.
            // 2.Restore properties.
            // 3.Get current properties.
            // 4.Diff to destroy.
            $exProperties = Property::getBillingDestinationProperties($billingDestination->id);
            if ($request->properties) {
                foreach($request->properties as $key => $property){
                    $property['billing_destination_id'] = $billingDestination->id;
                    $property['sort'] = $key;
                    Property::upsert($property,['id'],null);
                }
                $exId = $exProperties->pluck('id');
                $nowId = array_column($request->properties,'id');
                $delId = $exId->diff($nowId)->all();
                if($delId){
                    Property::destroy($delId);
                }
            }
        });
    }
}
