<x-scraft>
    <x-slot name="title">会社情報編集</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">会社情報編集</h1>
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('company-info.update') }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-form.label for="name" label="会社名"></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name', $companyInfo->name ?? '')"
                            required
                            class="@error('name') border-red-500 @enderror"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="zip" label="郵便番号"></x-form.label>
                        <x-form.input 
                            id="zip" 
                            name="zip" 
                            type="text" 
                            :value="old('zip', $companyInfo->zip ?? '')"
                            required
                            class="@error('zip') border-red-500 @enderror"
                        />
                        @error('zip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <x-form.label for="address" label="住所"></x-form.label>
                        <x-form.input 
                            id="address" 
                            name="address" 
                            type="text" 
                            :value="old('address', $companyInfo->address ?? '')"
                            required
                            class="@error('address') border-red-500 @enderror"
                        />
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="phone_no" label="電話番号"></x-form.label>
                        <x-form.input 
                            id="phone_no" 
                            name="phone_no" 
                            type="text" 
                            :value="old('phone_no', $companyInfo->phone_no ?? '')"
                            required
                            class="@error('phone_no') border-red-500 @enderror"
                        />
                        @error('phone_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="fax_no" label="FAX番号"></x-form.label>
                        <x-form.input 
                            id="fax_no" 
                            name="fax_no" 
                            type="text" 
                            :value="old('fax_no', $companyInfo->fax_no ?? '')"
                            class="@error('fax_no') border-red-500 @enderror"
                        />
                        @error('fax_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="invoice_no" label="インボイス番号"></x-form.label>
                        <x-form.input 
                            id="invoice_no" 
                            name="invoice_no" 
                            type="text" 
                            :value="old('invoice_no', $companyInfo->invoice_no ?? '')"
                            class="@error('invoice_no') border-red-500 @enderror"
                        />
                        @error('invoice_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="bank_name" label="銀行名"></x-form.label>
                        <x-form.input 
                            id="bank_name" 
                            name="bank_name" 
                            type="text" 
                            :value="old('bank_name', $companyInfo->bank_name ?? '')"
                            required
                            class="@error('bank_name') border-red-500 @enderror"
                        />
                        @error('bank_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="bank_branch" label="支店名"></x-form.label>
                        <x-form.input 
                            id="bank_branch" 
                            name="bank_branch" 
                            type="text" 
                            :value="old('bank_branch', $companyInfo->bank_branch ?? '')"
                            required
                            class="@error('bank_branch') border-red-500 @enderror"
                        />
                        @error('bank_branch')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="account_type" label="口座種別"></x-form.label>
                        <x-form.input 
                            id="account_type" 
                            name="account_type" 
                            type="text" 
                            :value="old('account_type', $companyInfo->account_type ?? '')"
                            required
                            class="@error('account_type') border-red-500 @enderror"
                        />
                        @error('account_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="account_name" label="口座名義"></x-form.label>
                        <x-form.input 
                            id="account_name" 
                            name="account_name" 
                            type="text" 
                            :value="old('account_name', $companyInfo->account_name ?? '')"
                            required
                            class="@error('account_name') border-red-500 @enderror"
                        />
                        @error('account_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">キャンセル</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">更新</button>
                </div>
            </form>
        </div>
    </div>
</x-scraft>
