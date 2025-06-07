<x-scraft>
    <x-slot name="title">顧客一覧</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">顧客一覧</h1>
                <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    新規顧客
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">顧客名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">並び順</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customers as $customer)
                            <tr>
                                <td class="px-6 py-4">{{ $customer->name }}</td>
                                <td class="px-6 py-4">{{ $customer->sort }}</td>
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
        </div>
    </div>
</x-scraft>
