<x-layout.scraft>
    <x-slot name="title">ユーザー情報</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">ユーザー情報</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600">ユーザー名</p>
                    <p class="font-semibold">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">メールアドレス</p>
                    <p class="font-semibold">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">登録日時</p>
                    <p class="font-semibold">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">更新日時</p>
                    <p class="font-semibold">{{ $user->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-4">
                <x-link scheme="base" :href="route('users.index')" button>戻る</x-link>
                <x-link scheme="scraft" :href="route('users.edit', $user)" button>編集</x-link>
                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button scheme="danger" onclick="return confirm('本当に削除しますか？')">削除</x-button>
                </form>
            </div>
        </div>
    </div>
</x-layout.scraft>
