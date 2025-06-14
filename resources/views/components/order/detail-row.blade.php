<tr class="order-detail-row">
    <td class="px-4 py-2 border border-gray-300">
        <div class="relative">
            <x-form.input 
                name="order_details[{{ $index }}][operation_name]" 
                type="text" 
                placeholder="作業内容を検索..."
                autocomplete="off"
                :value="old('order_details[$index][operation_name]')"
                class="operation-search"
            />
            <x-form.incremental-results class="operation-results"/>
            @error('order_details[{{ $index }}][operation_name]')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </div>
        <input type="hidden" class="operation-id" name="order_details[0][operation_id]">
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <div class="relative">
            <x-form.input 
                name="order_details[{{ $index }}][artisan_name]" 
                type="text" 
                placeholder="作業担当を検索..."
                autocomplete="off"
                :value="old('order_details[$index][artisan_name]')"
                class="artisan-search"
            />
            <x-form.incremental-results class="artisan-results"/>
            @error('order_details[{{ $index }}][artisan_name]')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </div>
        <input type="hidden" class="artisan-id" name="order_details[0][artisan_id]">
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <x-form.input 
            name="order_details[{{ $index }}][quantity]" 
            type="number" 
            :value="old('order_details[$index][quantity]')"
            class="quantity"
            onchange="calculatePrices(this)"
        />
        @error('order_details[{{ $index }}][quantity]')
            <x-form.error>{{ $message }}</x-form.error>
        @enderror
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <span class="unit-display"></span>
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <x-form.input 
            name="order_details[{{ $index }}][incoming_order_price]" 
            type="number" 
            :value="old('order_details[$index][incoming_order_price]')"
            class="incoming-price"
        />
        @error('order_details[{{ $index }}][incoming_order_price]')
            <x-form.error>{{ $message }}</x-form.error>
        @enderror
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <x-form.input 
            name="order_details[{{ $index }}][purchase_order_price]" 
            type="number" 
            :value="old('order_details[$index][purchase_order_price]')"
            class="purchase-price"
        />
        @error('order_details[{{ $index }}][purchase_order_price]')
            <x-form.error>{{ $message }}</x-form.error>
        @enderror
    </td>
    <td class="px-4 py-2 border border-gray-300">
        <x-button type="button" scheme="danger" class="remove-row" onclick="removeOrderDetailRow(this)">削除</x-button>
    </td>
</tr>
