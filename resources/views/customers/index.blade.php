<x-layout.scraft>
    <x-slot name="title">顧客一覧</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">顧客一覧</h1>
                <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    新規顧客
                </a>
            </div>
            <p class="text-xs">顧客の表はドラッグアンドドロップで並び順を変更できます。この表での並び順は、他の画面での顧客の並び順にも反映されます。</p>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8"></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">顧客名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[300px]">操作</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-customers" class="bg-white divide-y divide-gray-200">
                        @forelse($customers as $customer)
                            <tr data-customer-id="{{ $customer->id }}" class="sortable-row cursor-move">
                                <td class="px-6 py-4 text-gray-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4h14a1 1 0 010 2H3a1 1 0 010-2zM3 9h14a1 1 0 010 2H3a1 1 0 010-2zM3 14h14a1 1 0 010 2H3a1 1 0 010-2z"/>
                                    </svg>
                                </td>
                                <td class="px-6 py-4">{{ $customer->name }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('customers.show', $customer) }}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">表示</a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">編集</a>
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">顧客が登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sortableElement = document.getElementById('sortable-customers');
                    if (sortableElement && sortableElement.children.length > 0) {
                        const sortable = Sortable.create(sortableElement, {
                            handle: '.sortable-row',
                            animation: 150,
                            onEnd: function(evt) {
                                const customerIds = Array.from(sortableElement.children).map(row => {
                                    return row.getAttribute('data-customer-id');
                                }).filter(id => id !== null);

                                fetch('{{ route("customers.sort-order") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        customer_ids: customerIds
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (!data.success) {
                                        console.error('Failed to update sort order');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error updating sort order:', error);
                                });
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</x-layout.scraft>
