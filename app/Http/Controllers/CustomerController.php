<?php

namespace App\Http\Controllers;

use App\UseCase\CustomerUseCase;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = CustomerUseCase::getCustomersAll();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerStoreRequest $request)
    {
        Customer::validateIsUnique($request->name);

        Customer::createOrRecover([
            'name' => $request->name,
            'sort' => 0,
        ]);

        return redirect()->route('customers.index')->with('success', '顧客が登録されました。');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        Customer::validateIsUnique($request->name, $customer->id);

        $customer->update([
            'name' => $request->name,
        ]);

        return redirect()->route('customers.index')->with('success', '顧客情報が更新されました。');
    }

    public function destroy(Customer $customer)
    {
        if(CustomerUseCase::hasBillingDestinations($customer->id)){
            throw ValidationException::withMessages([
                'error' => ['この顧客には請求先が存在するため削除できません。'],
            ]);
        }
        $customer->delete();
        return redirect()->route('customers.index')->with('success', '顧客が削除されました。');
    }

    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
        ]);

        foreach ($request->customer_ids as $index => $customerId) {
            Customer::where('id', $customerId)->update(['sort' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
