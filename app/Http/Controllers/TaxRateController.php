<?php

namespace App\Http\Controllers;

use App\UseCase\TaxRateUseCase;
use App\Models\TaxRate;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    public function index()
    {
        $taxRates = TaxRateUseCase::getTaxRatesAll();
        return view('tax_rates.index', compact('taxRates'));
    }

    public function create()
    {
        return view('tax_rates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'apply_date' => 'required|date|unique:tax_rates,apply_date',
            'rate' => 'required|integer|min:0|max:100',
        ]);

        TaxRate::create([
            'apply_date' => $request->apply_date,
            'rate' => $request->rate,
        ]);

        return redirect()->route('tax-rates.index')->with('success', '消費税率が登録されました。');
    }

    public function edit(TaxRate $taxRate)
    {
        return view('tax_rates.edit', compact('taxRate'));
    }

    public function update(Request $request, TaxRate $taxRate)
    {
        $request->validate([
            'apply_date' => 'required|date|unique:tax_rates,apply_date,' . $taxRate->id,
            'rate' => 'required|integer|min:0|max:100',
        ]);

        $taxRate->update([
            'apply_date' => $request->apply_date,
            'rate' => $request->rate,
        ]);

        return redirect()->route('tax-rates.index')->with('success', '消費税率が更新されました。');
    }

    public function destroy(TaxRate $taxRate)
    {
        $taxRate->delete();
        return redirect()->route('tax-rates.index')->with('success', '消費税率が削除されました。');
    }
}
