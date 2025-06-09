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
            //Unique check for BillingDestination.name
            if(!BillingDestination::isUniqueInCustomer($request->customer_id,$request->name,$billingDestination?$billingDestination->id:null)){
                throw ValidationException::withMessages([
                    'name' => ['この顧客には既に同じ名称の請求先が存在します'],
                ]);
            }

            //Upsert BillingDestination
            $bdUpdate = [
                'customer_id' => $request->customer_id,
                'name' => $request->name,
                'due_day' => $request->due_day,
            ];
            if($billingDestination) $bdUpdate['id'] = $billingDestination->id;
            $billingDestination = $billingDestination->upsert($bdUpdate,['id'],['customer_id','name','due_day']);

            //BulkUpsert properties
            // 1.SoftDelete all
            // 2.Restore items if it's still remains
            // 3.Upsert with input data
            $billingDestination->properties->delete();
            if ($request->properties) {
                foreach ($request->properties as $index => $property) {
                    if(!Property::isUniqueInBillingDestination($billingDestination->id,$property['name'],$property['id']??null)){
                        $attr = 'properties.'.$index.'.name';
                        throw ValidationException::withMessages([
                            $attr => ['この請求先に同じ物件名が存在します'],
                        ]);
                    }
                    $propertyData = [
                        'name' => $property['name'],
                        'address' => $property['address'],
                        'sort' => $index + 1,
                    ];
                    if(isset($property['id'])){
                        $propertyData['id'] = $property['id'];
                        Property::onlyTrashed()->where('id','=',$property['id'])->restore();
                    }
                    Property::upsert($propertyData,['id'],['name','address','sort']);
                }
            }
        });

    }
}
