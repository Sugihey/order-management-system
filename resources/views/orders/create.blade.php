<x-layout.scraft>
    <x-slot name="title">新規受書注入力</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="新規受注書入力"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">新規受注書入力</h1>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form id="orderForm" method="POST" action="{{ route('orders.store') }}">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-8">
                    <!-- Row:1 -->
                    <div class="md:col-span-5">
                        <x-form.label for="title" label="件名" required="true" />
                        <x-form.input 
                            id="title" 
                            name="title" 
                            type="text" 
                            value="{{ old('title') }}"
                        />
                        @error('title')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-1">
                        <x-form.label for="order_no" label="発注番号" required="true" />
                        <x-form.input 
                            id="order_no" 
                            name="order_no" 
                            type="text" 
                            value="{{ old('order_no') }}"
                        />
                        @error('order_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="jurisdiction" label="管轄店" />
                        <x-form.input 
                            id="jurisdiction" 
                            name="jurisdiction" 
                            type="text" 
                            value="{{ old('jurisdiction') }}"
                        />
                        @error('jurisdiction')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="order_type" label="依頼区分" required="true" />
                        <div class="flex gap-4">
                            @foreach($orderTypes as $key => $orderType)
                            <div class="flex items-center">
                                <input class="form-radio" type="radio" name="order_type" id="order-type-{{ $orderType->value }}" value="{{ $orderType->value }}" {{ old('order_type') == $orderType->value ? 'checked' : '' }}/>
                                <label class="ml-2" for="order-type-{{ $orderType->value }}">{{ $orderType->label() }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="priority" label="優先度" required="true" />
                        <div class="flex gap-4">
                            @foreach($priorities as $priority)
                            <div class="flex items-center">
                                <input class="form-radio" type="radio" name="priority" id="priority-{{ $priority->value }}" value="{{ $priority->value }}" {{ old('priority') == $priority->value ? 'checked' : '' }}/>
                                <label class="ml-2" for="priority-{{ $priority->value }}">{{ $priority->label() }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('order_type')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <!-- Row:2 -->
                    <div class="md:col-span-4">
                        <x-form.label for="billing_destination_name" label="請求先" required="true" />
                        <div class="relative">
                            <x-form.input 
                                id="billing_destination_name" 
                                name="billing_destination_name" 
                                type="text" 
                                placeholder="請求先を検索もしくは入力..."
                                autocomplete="off"
                                value="{{ old('billing_destination_name') }}"
                            />
                            <x-form.incremental-results id="billing_destination_results"/>
                        </div>
                        <input type="hidden" id="billing_destination_id" name="billing_destination_id" value="{{ old('billing_destination_id') }}">
                        <input type="hidden" id="customer_id" name="customer_id" value="{{ old('customer_id') }}">
                        @error('billing_destination_id')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="customer_name" label="顧客" />
                        <x-form.input 
                            id="customer_name" 
                            name="customer_name"
                            type="text"
                            disabled="false"
                            value="{{ old('customer_name') }}"
                            class="disabled"
                        />
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="order_date" label="依頼日" required="true" />
                        <x-form.input 
                            id="order_date" 
                            name="order_date" 
                            type="date" 
                            value="{{ old('order_date') }}" 
                            required="true"
                        />
                        @error('order_date')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <x-form.label for="deadline" label="完了期日" required="true" />
                        <x-form.input 
                            id="deadline" 
                            name="deadline" 
                            type="date" 
                            value="{{ old('deadline') }}" 
                            required="true"
                        />
                        @error('deadline')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <!-- Row:3 -->
                    <div class="md:col-span-4">
                        <x-form.label for="property_name" label="物件" required="true" />
                        <div class="relative">
                            <x-form.input 
                                id="property_name" 
                                name="property_name" 
                                type="text" 
                                placeholder="先に請求先を選択してください"
                                autocomplete="off"
                                disabled="{{ old('billing_destination_name')=='' }}"
                                value="{{ old('property_name') }}"
                            />
                            <x-form.incremental-results id='property_results'/>
                        </div>
                        @error('property_name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-6">
                        <x-form.label for="property_address" label="物件住所" required="true" />
                        <x-form.input 
                            id="property_address" 
                            name="property_address" 
                            type="text" 
                            value="{{ old('property_address') }}"
                        />
                        @error('property_address')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="md:col-span-1">
                        <x-form.label for="room_no" label="部屋番号" />
                        <x-form.input 
                            id="room_no" 
                            name="room_no" 
                            type="text" 
                            value="{{ old('room_no') }}"
                        />
                        @error('room_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <!-- Row:4 -->
                    <div class="md:col-span-10">
                        <x-form.label for="description" label="備考" />
                        <x-form.input 
                            id="description" 
                            name="description" 
                            type="text" 
                            value="{{ old('description') }}"
                        />
                        @error('description')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <!-- Row:5 -->
                    <div class="md:col-span-2 flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="is_photo_required" name="is_photo_required" value="1" {{ old('is_photo_required') ? 'checked' : '' }} class="mr-2">
                            写真必要
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="is_call_required" name="is_call_required" value="1" {{ old('is_call_required') ? 'checked' : '' }} class="mr-2" onchange="toggleResidentFields()">
                            電話確認
                        </label>
                    </div>

                    <!-- Row:6 -->
                    <div id="resident_name_div" class="hidden md:col-span-2">
                        <x-form.label for="resident_name" label="入居者名" required="true" />
                        <x-form.input 
                            id="resident_name" 
                            name="resident_name" 
                            type="text" 
                            value="{{ old('resident_name') }}"
                        />
                        @error('resident_name')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <div id="resident_phone_div" class="hidden md:col-span-2">
                        <x-form.label for="resident_phone_no" label="入居者TEL" required="true"/>
                        <x-form.input 
                            id="resident_phone_no" 
                            name="resident_phone_no" 
                            type="text" 
                            value="{{ old('resident_phone_no') }}"
                        />
                        @error('resident_phone_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>

                <!-- 明細部 -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4">作業明細</h2>
                    <!-- div class="overflow-x-auto" -->
                        <table id="orderDetailsTable" class="min-w-full border border-gray-300 mb-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300 text-left">作業内容</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">作業担当</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-36">数量</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-18">単位</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-36">受注価格</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-36">発注価格</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-24">操作</th>
                                </tr>
                            </thead>
                            <tbody id="orderDetailsBody">
                                @for($index=0;$index<$detailRow;$index++)
                                <x-order.detail-row :index="$index"/>
                                @endfor
                            </tbody>
                        </table>
                    <!-- /div -->
                    <x-button type="button" id="addRowBtn" scheme="scraft" onclick="addOrderDetailRow()">行追加</x-button>
                </div>

                <!-- ボタン　-->
                <div class="flex justify-end space-x-4">
                    <x-link scheme="base" button :href="route('dashboard')" class="px-6 py-2">キャンセル</x-link>
                    <x-button type="submit" scheme="action" class="px-6 py-2">登録</x-button>
                </div>
            </form>
        </div>
    </div>

    <!-- 作業員募集期限ダイアログ -->
    <div id="assignDeadlineModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-bold mb-4">作業員募集期限</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">募集期限</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="date" id="assign_deadline_date" class="px-3 py-2 border border-gray-300 rounded-md">
                    <input type="time" id="assign_deadline_time" class="px-3 py-2 border border-gray-300 rounded-md">
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <x-button type="button" class="px-4 py-2" scheme="base" onclick="closeAssignDeadlineModal()">閉じる</x-button>
                <x-button type="button" class="px-4 py-2" scheme="action" onclick="submitWithAssignDeadline()">登録</x-button>
            </div>
        </div>
    </div>

    <script>
        let debounceTimer;
        let unitPricesData = {};
        let rowIndex = 1;

        function debounce(func, wait) {
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(debounceTimer);
                    func(...args);
                };
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(later, wait);
            };
        }

        function setupBillingDestinationSearch() {
            const searchInput = document.getElementById('billing_destination_name');
            const resultsDiv = document.getElementById('billing_destination_results');
            let selectedIndex = -1;
            
            searchInput.addEventListener('input', debounce(function(e) {
                resetBillingDestination();
                const query = e.target.value.trim();
                if (query.length < 1) {
                    resultsDiv.classList.add('hidden');
                    return;
                }
                fetch(`{{ route('orders.api.billing-destinations.search') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayBillingDestinationResults(data.data);
                        selectedIndex = -1; // 検索結果が更新されたら選択をリセット
                    }
                })
                .catch(error => console.error('Error:', error));
            }, 300));

            // キーボードナビゲーションの追加
            searchInput.addEventListener('keydown', function(e) {
                const items = resultsDiv.querySelectorAll('div > div.result-item');
                
                switch(e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        if (selectedIndex < items.length - 1) {
                            selectedIndex++;
                            updateSelection(items, selectedIndex);
                        }
                        break;
                        
                    case 'ArrowUp':
                        e.preventDefault();
                        if (selectedIndex > 0) {
                            selectedIndex--;
                            updateSelection(items, selectedIndex);
                        }
                        break;
                        
                    case 'Enter':
                        e.preventDefault();
                        if (selectedIndex >= 0 && items[selectedIndex]) {
                            const item = items[selectedIndex].closest('div');
                            const itemData = {
                                name: item.querySelector('.font-medium').textContent,
                                id: item.dataset.id,
                                customer_id: item.dataset.customerId,
                                customer_name: item.querySelector('.text-sm').textContent
                            };
                            selectBillingDestination(itemData);
                        }
                        break;

                    case 'Tab':
                        console.log('tab');
                        break;
                }
            });
        }

        function displayBillingDestinationResults(results) {
            const resultsDiv = document.getElementById('billing_destination_results');
            resultsDiv.innerHTML = '';
            
            if (results.length === 0) {
                resultsDiv.innerHTML = '<div class="p-2 text-gray-500">該当する請求先が見つかりません</div>';
            } else {
                results.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'result-item p-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200';
                    div.dataset.id = item.id;
                    div.dataset.customerId = item.customer_id;
                    div.innerHTML = `<x-form.incremental-result-item title="${item.name}" description="${item.customer_name}"/>`;
                    div.onclick = () => selectBillingDestination(item);
                    resultsDiv.appendChild(div);
                });
            }
            
            resultsDiv.classList.remove('hidden');
        }

        function updateSelection(items, selectedIndex) {
            items.forEach((item, index) => {
                if (index === selectedIndex) {
                    item.closest('div').classList.add('bg-gray-100');
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.closest('div').classList.remove('bg-gray-100');
                }
            });
        }

        function selectBillingDestination(item) {
            document.getElementById('billing_destination_name').value = item.name;
            document.getElementById('billing_destination_id').value = item.id;
            document.getElementById('customer_id').value = item.customer_id;
            document.getElementById('billing_destination_results').classList.add('hidden');
            document.getElementById('customer_name').value = item.customer_name;
            
            document.getElementById('property_name').disabled = false;
            document.getElementById('property_name').placeholder = '物件を検索...';
            
            loadUnitPrices(item.customer_id);
            loadProperties(item.id);
        }

        function resetBillingDestination() {
            document.getElementById('billing_destination_id').value = '';
            document.getElementById('customer_id').value = '';
            document.getElementById('customer_name').value = '';
            
            document.getElementById('property_name').disabled = true;
            document.getElementById('property_name').placeholder = '先に請求先を選択してください';
            document.getElementById('property_name').value = '';
            document.getElementById('property_address').value = '';
        }
        function selectOtherBillingDestination() {
            if(document.getElementById('billing_destination_id').value == '' && document.getElementById('billing_destination_name').value != '') {
                document.getElementById('billing_destination_id').value = '{{ $others->id }}';
                document.getElementById('customer_id').value = '{{ $others->Customer->id }}';
                document.getElementById('billing_destination_results').classList.add('hidden');
                document.getElementById('customer_name').value = '{{ $others->Customer->name }}';
                
                document.getElementById('property_name').disabled = false;
                document.getElementById('property_name').placeholder = '物件を入力...';
                document.getElementById('property_name').value = '';
                document.getElementById('property_address').value = '';

                loadUnitPrices({{ $others->Customer->id }});
            }
        }

        function loadProperties(billingDestinationId) {
            fetch(`{{ url('/orders/api/properties') }}/${billingDestinationId}`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setupPropertySearch(data.data);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function setupPropertySearch(properties) {
            const searchInput = document.getElementById('property_name');
            const resultsDiv = document.getElementById('property_results');
            
            searchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                if (query.length < 1) {
                    resultsDiv.classList.add('hidden');
                    return;
                }
                
                const filteredProperties = properties.filter(property => 
                    property.name.toLowerCase().includes(query)
                );
                
                displayPropertyResults(filteredProperties);
            });
        }

        function displayPropertyResults(results) {
            const resultsDiv = document.getElementById('property_results');
            resultsDiv.innerHTML = '';
            
            if (results.length === 0) {
                resultsDiv.innerHTML = '<div class="p-2 text-gray-500">該当する物件が見つかりません</div>';
            } else {
                results.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'p-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200';
                    div.innerHTML = `<x-form.incremental-result-item title="${item.name}" description="${item.address}"/>`;
                    div.onclick = () => selectProperty(item);
                    resultsDiv.appendChild(div);
                });
            }
            
            resultsDiv.classList.remove('hidden');
        }

        function selectProperty(item) {
            document.getElementById('property_name').value = item.name;
            document.getElementById('property_address').value = item.address;
            document.getElementById('property_results').classList.add('hidden');
        }

        function loadUnitPrices(customerId) {
            fetch(`{{ url('/orders/api/unit-prices') }}/${customerId}`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    unitPricesData = {};
                    data.data.forEach(item => {
                        unitPricesData[item.operation_id] = {
                            incoming_order_price: item.incoming_order_price,
                            purchase_order_price: item.purchase_order_price
                        };
                    });
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function setupOperationSearch(row) {
            const searchInput = row.querySelector('.operation-search');
            const resultsDiv = row.querySelector('.operation-results');
            
            searchInput.addEventListener('input', debounce(function(e) {
                const query = e.target.value.trim();
                if (query.length < 1) {
                    resultsDiv.classList.add('hidden');
                    return;
                }
                
                fetch(`{{ route('orders.api.operations.search') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayOperationResults(resultsDiv, data.data, row);
                    }
                })
                .catch(error => console.error('Error:', error));
            }, 300));
        }

        function displayOperationResults(resultsDiv, results, row) {
            resultsDiv.innerHTML = '';
            
            if (results.length === 0) {
                resultsDiv.innerHTML = '<div class="p-2 text-gray-500">該当する作業内容が見つかりません</div>';
            } else {
                results.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'p-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200';
                    div.innerHTML = `<x-form.incremental-result-item title="${item.name}" description="単位: ${item.unit}"/>`;
                    div.onclick = () => selectOperation(item, row);
                    resultsDiv.appendChild(div);
                });
            }
            
            resultsDiv.classList.remove('hidden');
        }

        function selectOperation(item, row) {
            row.querySelector('.operation-search').value = item.name;
            row.querySelector('.operation-id').value = item.id;
            row.querySelector('.unit-display').textContent = item.unit;
            row.querySelector('.operation-results').classList.add('hidden');
            
            calculatePrices(row.querySelector('.quantity'));
        }

        function setupArtisanSearch(row) {
            const searchInput = row.querySelector('.artisan-search');
            const resultsDiv = row.querySelector('.artisan-results');
            
            searchInput.addEventListener('input', debounce(function(e) {
                const query = e.target.value.trim();
                if (query.length < 1) {
                    resultsDiv.classList.add('hidden');
                    return;
                }
                
                fetch(`{{ route('orders.api.artisans.search') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayArtisanResults(resultsDiv, data.data, row);
                    }
                })
                .catch(error => console.error('Error:', error));
            }, 300));
        }

        function displayArtisanResults(resultsDiv, results, row) {
            resultsDiv.innerHTML = '';
            
            if (results.length === 0) {
                resultsDiv.innerHTML = '<div class="p-2 text-gray-500">該当する作業担当が見つかりません</div>';
            } else {
                results.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'p-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200';
                    div.innerHTML = `<x-form.incremental-result-item title="${item.name}" description=""/>`;
                    div.onclick = () => selectArtisan(item, row);
                    resultsDiv.appendChild(div);
                });
            }
            
            resultsDiv.classList.remove('hidden');
        }

        function selectArtisan(item, row) {
            row.querySelector('.artisan-search').value = item.name;
            row.querySelector('.artisan-id').value = item.id;
            row.querySelector('.artisan-results').classList.add('hidden');
        }

        function calculatePrices(quantityInput) {
            const row = quantityInput.closest('.order-detail-row');
            const operationId = row.querySelector('.operation-id').value;
            const quantity = parseFloat(quantityInput.value) || 0;
            
            if (operationId && unitPricesData[operationId] && quantity > 0) {
                const unitPrice = unitPricesData[operationId];
                const incomingTotal = unitPrice.incoming_order_price * quantity;
                const purchaseTotal = unitPrice.purchase_order_price * quantity;
                
                row.querySelector('.incoming-price').value = incomingTotal.toFixed(2);
                row.querySelector('.purchase-price').value = purchaseTotal.toFixed(2);
            }
        }

        function addOrderDetailRow() {
            const tbody = document.getElementById('orderDetailsBody');
            const newRow = document.createElement('tr');
            newRow.className = 'order-detail-row';
            newRow.innerHTML = `<x-order.detail-row index="${rowIndex}" />`;
            
            tbody.appendChild(newRow);
            setupOperationSearch(newRow);
            setupArtisanSearch(newRow);
            rowIndex++;
        }

        function removeOrderDetailRow(button) {
            const row = button.closest('.order-detail-row');
            const tbody = document.getElementById('orderDetailsBody');
            if (tbody.children.length > 1) {
                row.remove();
                updateRowIndices();
            }
        }

        function updateRowIndices() {
            const rows = document.querySelectorAll('.order-detail-row');
            rows.forEach((row, index) => {
                const inputs = row.querySelectorAll('input[name*="order_details"]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/order_details\[\d+\]/, `order_details[${index}]`));
                    }
                });
            });
        }

        function toggleResidentFields() {
            const isCallRequired = document.getElementById('is_call_required').checked;
            const residentNameDiv = document.getElementById('resident_name_div');
            const residentPhoneDiv = document.getElementById('resident_phone_div');
            
            if (isCallRequired) {
                residentNameDiv.classList.remove('hidden');
                residentPhoneDiv.classList.remove('hidden');
            } else {
                residentNameDiv.classList.add('hidden');
                residentPhoneDiv.classList.add('hidden');
                document.getElementById('resident_name').value = '';
                document.getElementById('resident_phone_no').value = '';
            }
        }

        function validateDates() {
            const orderDate = document.getElementById('order_date').value;
            const deadline = document.getElementById('deadline').value;
            
            if (orderDate && deadline && new Date(orderDate) > new Date(deadline)) {
                alert('依頼日は完了期日より前の日付を入力してください。');
                return false;
            }
            return true;
        }

        function checkUnassignedArtisans() {
            const rows = document.querySelectorAll('.order-detail-row');
            let hasUnassigned = false;
            
            rows.forEach(row => {
                const artisanId = row.querySelector('.artisan-id').value;
                if (!artisanId) {
                    hasUnassigned = true;
                }
            });
            
            return hasUnassigned;
        }

        function showAssignDeadlineModal() {
            const modal = document.getElementById('assignDeadlineModal');
            const now = new Date();
            now.setMinutes(now.getMinutes() + 30);
            
            const dateStr = now.toISOString().split('T')[0];
            const timeStr = now.toTimeString().slice(0, 5);
            
            document.getElementById('assign_deadline_date').value = dateStr;
            document.getElementById('assign_deadline_time').value = timeStr;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAssignDeadlineModal() {
            const modal = document.getElementById('assignDeadlineModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitWithAssignDeadline() {
            const date = document.getElementById('assign_deadline_date').value;
            const time = document.getElementById('assign_deadline_time').value;
            
            if (date && time) {
                const assignDeadline = `${date} ${time}:00`;
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'assign_deadline';
                hiddenInput.value = assignDeadline;
                document.getElementById('orderForm').appendChild(hiddenInput);
            }
            
            closeAssignDeadlineModal();
            document.getElementById('orderForm').submit();
        }

        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateDates()) {
                return;
            }
            
            if (checkUnassignedArtisans()) {
                showAssignDeadlineModal();
            } else {
                this.submit();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            setupBillingDestinationSearch();
            setupOperationSearch(document.querySelector('.order-detail-row'));
            setupArtisanSearch(document.querySelector('.order-detail-row'));
            
            if (document.getElementById('is_call_required').checked) {
                toggleResidentFields();
            }
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.relative')) {
                    document.querySelectorAll('.absolute').forEach(div => {
                        if(div.id == 'billing_destination_results'){
                            selectOtherBillingDestination()
                        }
                        div.classList.add('hidden');
                    });
                }
            });
        });
    </script>
</x-layout.scraft>
