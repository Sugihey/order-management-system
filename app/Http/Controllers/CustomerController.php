<?php

namespace App\Http\Controllers;

use App\UseCase\CustomerUseCase;
use App\Models\Customer;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Customer::create([
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

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $customer->update([
            'name' => $request->name,
        ]);

        return redirect()->route('customers.index')->with('success', '顧客情報が更新されました。');
    }

    public function destroy(Customer $customer)
    {
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
