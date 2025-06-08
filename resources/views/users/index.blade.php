<x-layout.scraft>
    <x-slot name="title">ユーザー一覧</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="ユーザー一覧"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">ユーザー一覧</h1>
                <x-link scheme="scraft" :href="route('users.create')" button>新規ユーザー</x-link>
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
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ユーザー名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">メールアドレス</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[300px]">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <x-link scheme="scraft" :href="route('users.show', $user)" button>表示</x-link>
                                    <x-link scheme="action" :href="route('users.edit', $user)" button>編集</x-link>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button scheme="danger" onclick="return confirm('ユーザー「{{$user->name}}」を本当に削除しますか？')">削除</x-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">ユーザーが登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.scraft>
