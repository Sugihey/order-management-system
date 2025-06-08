<x-layout.scraft>
    <x-slot name="title">職人一覧</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="職人一覧"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">職人一覧</h1>
                <x-link scheme="scraft" :href="route('artisans.create')" button>新規職人</x-link>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名前</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">電話番号</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">住所</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">メールアドレス</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[300px]">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($artisans as $artisan)
                            <tr>
                                <td class="px-6 py-4">{{ $artisan->name }}</td>
                                <td class="px-6 py-4">{{ $artisan->phone_no }}</td>
                                <td class="px-6 py-4">{{ $artisan->address }}</td>
                                <td class="px-6 py-4">{{ $artisan->email }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <x-link scheme="scraft" :href="route('artisans.show', $artisan)" button>表示</x-link>
                                    <x-link scheme="action" :href="route('artisans.edit', $artisan)" button>編集</x-link>
                                    <form method="POST" action="{{ route('artisans.destroy', $artisan) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button scheme="danger" onclick="return confirm('職人「{{$artisan->name}}」を本当に削除しますか？')">削除</x-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">職人が登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.scraft>
