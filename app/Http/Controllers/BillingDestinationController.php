<?php

namespace App\Http\Controllers;

use App\UseCase\BillingDestinationUseCase;
use App\Models\BillingDestination;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BiilingDestinationStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BillingDestinationController extends Controller
{
    public function index()
    {
        $billingDestinations = BillingDestinationUseCase::getBillingDestinationsAll();
        return view('billing_destinations.index', compact('billingDestinations'));
    }

    public function create(Request $request)
    {
        $properties = $request->old('properties');
        $propertyRow = isset($properties) ? count($properties) : 1;
        $customers = BillingDestinationUseCase::getCustomersForSelection();
        return view('billing_destinations.create', compact('customers','propertyRow'));
    }

    public function store(BiilingDestinationStoreRequest $request): RedirectResponse
    {
        try {
            BillingDestinationUseCase::storeBillingDestinationAndProperties($request);
        }catch(ValidationException $e) {

        }catch(\Exception $e) {
            return redirect()->route('billing_destinations.create')->with('success', '請求先の登録に失敗しました。');
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

    public function update(BiilingDestinationStoreRequest $request, BillingDestination $billingDestination)
    {
        try{
            BillingDestinationUseCase::storeBillingDestinationAndProperties($request, $billingDestination);
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
