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
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">戻る</a>
                <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">編集</a>
                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </div>
        </div>
    </div>
</x-layout.scraft>
