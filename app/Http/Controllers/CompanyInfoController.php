<?php

namespace App\Http\Controllers;

use App\UseCase\CompanyInfoUseCase;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function edit()
    {
        $companyInfo = CompanyInfoUseCase::get();
        return view('company_info.edit', compact('companyInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:46',
            'zip' => 'required|string|max:12',
            'address' => 'required|string|max:256',
            'phone_no' => 'required|string|max:20',
            'fax_no' => 'nullable|string|max:20',
            'invoice_no' => 'nullable|string|max:14',
            'bank_name' => 'required|string|max:46',
            'bank_branch' => 'required|string|max:46',
            'account_type' => 'required|string|max:10',
            'account_name' => 'required|string|max:46',
        ]);

        $companyInfo = CompanyInfo::firstOrNew();
        $companyInfo->fill($request->all());
        $companyInfo->save();

        return redirect()->route('company-info.edit')->with('success', '会社情報が更新されました。');
    }
}
