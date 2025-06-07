<x-scraft>
    <x-slot name="title">顧客情報</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">顧客情報</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600">名前</p>
                    <p class="font-semibold">{{ $customer->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">並び順</p>
                    <p class="font-semibold">{{ $customer->sort }}</p>
                </div>
                <div>
                    <p class="text-gray-600">登録日時</p>
                    <p class="font-semibold">{{ $customer->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">更新日時</p>
                    <p class="font-semibold">{{ $customer->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-4">
                <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">戻る</a>
                <a href="{{ route('customers.edit', $customer) }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">編集</a>
                <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </div>
        </div>
    </div>
</x-scraft>
