<x-layout.scraft>
    <x-slot name="title">作業単価一覧</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="作業単価一覧"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">作業単価一覧</h1>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <div class="mb-4">
                    <x-form.label for="customer_select" label="顧客" />
                    <select id="customer_select" class="w-auto p-2 border rounded" onchange="changePriceList(this.value)">
                        <option value="">選択してください</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <form id="unit_price_form" style="display: none;">
                    @csrf
                    <input type="hidden" id="selected_customer_id" name="customer_id" value="">
                    
                    <table id="priceTable" class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名称</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">単位</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">受注単価</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">発注単価</th>
                            </tr>
                        </thead>
                        <tbody id="operations_tbody" class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                    
                    <div class="mt-6 flex justify-end space-x-4">
                        <x-button scheme="base" button class="px-4 py-2" onclick="cancel()">キャンセル</x-button>
                        <x-button type="submit" scheme="action" id="register_btn" class="px-4 py-2">登録</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let isSubmitting = false;

        function changePriceList(customerId) {
            const form = document.getElementById('unit_price_form');
            const customerIdInput = document.getElementById('selected_customer_id');
            
            if (customerId === '') {
                form.style.display = 'none';
                return;
            }

            customerIdInput.value = customerId;
            
            fetch('{{ route("unit-prices.operations") }}?' + new URLSearchParams({
                customer_id: customerId
            }), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderOperationsTable(data.operations);
                    form.style.display = 'block';
                } else {
                    console.error('Failed to fetch operations');
                }
            })
            .catch(error => {
                console.error('Error fetching operations:', error);
            });
        }

        function renderOperationsTable(operations) {
            const tbody = document.getElementById('operations_tbody');
            tbody.innerHTML = '';

            operations.forEach(operation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4">${operation.name}</td>
                    <td class="px-6 py-4">${operation.unit}</td>
                    <td class="px-6 py-4">
                        <input type="number" 
                               name="unit_prices[${operation.id}][incoming_order_price]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               value="${operation.incoming_order_price || 0}" 
                               step="0.01" min="0">
                        <input type="hidden" name="unit_prices[${operation.id}][operation_id]" value="${operation.id}">
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" 
                               name="unit_prices[${operation.id}][purchase_order_price]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               value="${operation.purchase_order_price || 0}" 
                               step="0.01" min="0">
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function cancel() {
            document.getElementById('customer_select').value = '';
            document.getElementById('unit_price_form').style.display = 'none';
        }

        document.getElementById('unit_price_form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isSubmitting) {
                return;
            }
            
            isSubmitting = true;
            const registerBtn = document.getElementById('register_btn');
            registerBtn.textContent = '保存中...';
            registerBtn.disabled = true;

            const formData = new FormData(this);
            const unitPricesData = {};
            
            for (let [key, value] of formData.entries()) {
                if (key.startsWith('unit_prices[')) {
                    const matches = key.match(/unit_prices\[(\d+)\]\[(\w+)\]/);
                    if (matches) {
                        const operationId = matches[1];
                        const field = matches[2];
                        if (!unitPricesData[operationId]) {
                            unitPricesData[operationId] = {};
                        }
                        unitPricesData[operationId][field] = value;
                    }
                }
            }

            const submitData = {
                customer_id: formData.get('customer_id'),
                unit_prices: Object.values(unitPricesData)
            };

            fetch('{{ route("unit-prices.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(submitData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('保存に失敗しました。');
                }
            })
            .catch(error => {
                console.error('Error saving unit prices:', error);
                alert('保存中にエラーが発生しました。');
            })
            .finally(() => {
                isSubmitting = false;
                registerBtn.textContent = '登録';
                registerBtn.disabled = false;
            });
        });
    </script>
</x-layout.scraft>
