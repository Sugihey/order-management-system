<x-layout.scraft>
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
                <x-link scheme="base" :href="route('customers.index')" button>戻る</x-link>
                <x-link scheme="scraft" :href="route('customers.edit', $customer)" button>編集</x-link>
                <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button scheme="danger" onclick="return confirm('この顧客を本当に削除しますか？')">削除</x-button>
                </form>
            </div>
        </div>
    </div>
</x-layout.scraft>
