<x-layout.scraft>
    <x-slot name="title">会社情報編集</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="会社情報編集"/>
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
                        <x-form.label for="name" label="会社名" required></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name', $companyInfo->name ?? '')"
                            required
                        />
                        @error('name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="zip" label="郵便番号" required></x-form.label>
                        <x-form.input 
                            id="zip" 
                            name="zip" 
                            type="text" 
                            :value="old('zip', $companyInfo->zip ?? '')"
                            required
                        />
                        @error('zip')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <x-form.label for="address" label="住所" required></x-form.label>
                        <x-form.input 
                            id="address" 
                            name="address" 
                            type="text" 
                            :value="old('address', $companyInfo->address ?? '')"
                            required
                        />
                        @error('address')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="phone_no" label="電話番号" required></x-form.label>
                        <x-form.input 
                            id="phone_no" 
                            name="phone_no" 
                            type="text" 
                            :value="old('phone_no', $companyInfo->phone_no ?? '')"
                            required
                        />
                        @error('phone_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="email" label="メールアドレス"></x-form.label>
                        <x-form.input 
                            id="email" 
                            name="email" 
                            type="email" 
                            :value="old('email', $companyInfo->email ?? '')"
                        />
                        @error('email')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="fax_no" label="FAX番号"></x-form.label>
                        <x-form.input 
                            id="fax_no" 
                            name="fax_no" 
                            type="text" 
                            :value="old('fax_no', $companyInfo->fax_no ?? '')"
                        />
                        @error('fax_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="invoice_no" label="インボイス番号"></x-form.label>
                        <x-form.input 
                            id="invoice_no" 
                            name="invoice_no" 
                            type="text" 
                            :value="old('invoice_no', $companyInfo->invoice_no ?? '')"
                        />
                        @error('invoice_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="bank_name" label="銀行名" required></x-form.label>
                        <x-form.input 
                            id="bank_name" 
                            name="bank_name" 
                            type="text" 
                            :value="old('bank_name', $companyInfo->bank_name ?? '')"
                            required
                        />
                        @error('bank_name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="bank_branch" label="支店名" required></x-form.label>
                        <x-form.input 
                            id="bank_branch" 
                            name="bank_branch" 
                            type="text" 
                            :value="old('bank_branch', $companyInfo->bank_branch ?? '')"
                            required
                        />
                        @error('bank_branch')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="account_type" label="口座種別" required></x-form.label>
                        <x-form.input 
                            id="account_type" 
                            name="account_type" 
                            type="text" 
                            :value="old('account_type', $companyInfo->account_type ?? '')"
                            required
                        />
                        @error('account_type')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    
                    <div>
                        <x-form.label for="account_name" label="口座名義" required></x-form.label>
                        <x-form.input 
                            id="account_name" 
                            name="account_name" 
                            type="text" 
                            :value="old('account_name', $companyInfo->account_name ?? '')"
                            required
                        />
                        @error('account_name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <x-link scheme="base" :href="route('dashboard')" button>キャンセル</x-link>
                    <x-button scheme="action" type="submit">更新</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
