<?php

namespace App\Http\Controllers;

use App\UseCase\TaxRateUseCase;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use App\Http\Requests\TaxRateStoreRequest;

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

    public function store(TaxRateStoreRequest $request)
    {
        TaxRate::validateIsUniqueApplyDate($request->apply_date);
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

    public function update(TaxRateStoreRequest $request, TaxRate $taxRate)
    {
        TaxRate::validateIsUniqueApplyDate($request->apply_date, $taxRate->id);
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
