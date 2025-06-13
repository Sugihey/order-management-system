<x-layout.scraft>
    <x-slot name="title">請求先一覧</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="請求先一覧"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">請求先一覧</h1>
                <x-link scheme="scraft" :href="route('billing_destinations.create')" button>新規請求先</x-link>
            </div>
            
            @if(session('success'))
                <x-alert scheme="success">{{ session('success') }}</x-alert>
            @endif
            
            <div class="mb-6">
                <form method="GET" action="{{ route('billing_destinations.index') }}" class="flex items-center gap-4">
                    <label for="customer_filter" class="text-sm font-medium text-gray-700">顧客で絞り込み:</label>
                    <select id="customer_filter" name="customer_id" class="border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                        <option value="">すべての顧客</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customerId == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">請求先名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">顧客</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">締め日</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[300px]">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($billingDestinations as $billingDestination)
                            <tr>
                                <td class="px-6 py-4">{{ $billingDestination->name }}</td>
                                <td class="px-6 py-4">{{ $billingDestination->customer->name }}</td>
                                <td class="px-6 py-4">{{ $billingDestination->due_day == 31 ? '31日(月末)' : $billingDestination->due_day . '日' }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <x-link scheme="scraft" :href="route('billing_destinations.show', $billingDestination)" button>表示</x-link>
                                    <x-link scheme="action" :href="route('billing_destinations.edit', $billingDestination)" button>編集</x-link>
                                    <form method="POST" action="{{ route('billing_destinations.destroy', $billingDestination) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button scheme="danger" onclick="return confirm('請求先「{{$billingDestination->name}}」を本当に削除しますか？')">削除</x-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">請求先が登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.scraft>
