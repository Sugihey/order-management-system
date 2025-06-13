<x-layout.scraft>
    <x-slot name="title">請求先情報編集</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'請求先一覧','route'=>'billing_destinations.index']]" current="請求先情報編集"/>
            <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">請求先情報編集</h1>
            
            @if(session('error'))
                <x-alert scheme="danger">{{ session('error') }}</x-alert>
            @endif
            @error('details')
                <x-alert scheme="danger">{{ $message }}</x-alert>
            @enderror
            <form method="POST" action="{{ route('billing_destinations.update', $billingDestination) }}" id="billingDestinationForm">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <x-form.label for="customer" label="顧客" required></x-form.label>
                        <x-form.input 
                            id="customer_display" 
                            name="customer_display"
                            type="text" 
                            :value="old('customer_display', $billingDestination->customer->name)"
                            readonly
                            onClick="showCustomerDialog()"
                            placeholder="顧客を選択してください"
                            required
                        />
                        <input type="hidden" id="customer_id" name="customer_id" value="{{ old('customer_id', $billingDestination->customer_id) }}">
                        @error('customer_id')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="name" label="請求先名称" required></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name', $billingDestination->name)"
                            required
                        />
                        @error('name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div>
                        <x-form.label for="due_day" label="締め日" required></x-form.label>
                        <select name="due_day" id="due_day" class="mt-1 block w-auto px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">選択してください</option>
                            @for($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" {{ old('due_day', $billingDestination->due_day) == $i ? 'selected' : '' }}>
                                    {{ $i == 31 ? '31日(月末)' : $i . '日' }}
                                </option>
                            @endfor
                        </select>
                        @error('due_day')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">物件情報</h2>
                        <x-button type="button" scheme="scraft" onClick="addPropertyRow()">物件追加</x-button>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full" id="propertyTable">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">物件名</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">住所</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="propertyTableBody">
                                @forelse($properties as $index => $property)
                                <x-billingDestination.detail-row :index="$index" :property="$property"/>
                                @empty
                                <x-billingDestination.detail-row :index="0"/>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex gap-4">
                    <x-link scheme="base" :href="route('billing_destinations.index')" button>キャンセル</x-link>
                    <x-button scheme="action">更新</x-button>
                </div>
            </form>
        </div>
    </div>

    <div class="dialog-backdrop" id="customerDialogBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;"></div>
    <div class="dialog" id="customerDialog" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 1000;">
        <h4 class="text-lg font-bold mb-4">顧客選択</h4>
        @foreach($customers as $customer)
            <div class="selectable-item cursor-pointer p-2 hover:bg-gray-100 rounded" onclick="selectCustomer('{{ $customer->name }}', {{ $customer->id }})">
                {{ $customer->name }}
            </div>
        @endforeach
    </div>

    <script>
        let propertyIndex = {{ count($billingDestination->properties) }};

        function addPropertyRow() {
            const tbody = document.getElementById('propertyTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `<x-billingDestination.detail-row index="${propertyIndex}"/>`;
            tbody.appendChild(newRow);
            propertyIndex++;
        }

        function removePropertyRow(button) {
            const tbody = document.getElementById('propertyTableBody');
            button.closest('tr').remove();
        }

        function showCustomerDialog() {
            document.getElementById('customerDialog').style.display = 'block';
            document.getElementById('customerDialogBackdrop').style.display = 'block';
        }

        function hideCustomerDialog() {
            document.getElementById('customerDialog').style.display = 'none';
            document.getElementById('customerDialogBackdrop').style.display = 'none';
        }

        function selectCustomer(customerName, customerId) {
            document.getElementById('customer_display').value = customerName;
            document.getElementById('customer_id').value = customerId;
            hideCustomerDialog();
        }

        document.getElementById('customerDialogBackdrop').addEventListener('click', hideCustomerDialog);
    </script>
</x-layout.scraft>
