<x-layout.scraft>
    <x-slot name="title">職人情報</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'職人一覧','route'=>'artisans.index']]" current="職人情報"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">職人情報</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600">名前</p>
                    <p class="font-semibold">{{ $artisan->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">電話番号</p>
                    <p class="font-semibold">{{ $artisan->phone_no }}</p>
                </div>
                <div>
                    <p class="text-gray-600">住所</p>
                    <p class="font-semibold">{{ $artisan->address }}</p>
                </div>
                <div>
                    <p class="text-gray-600">メールアドレス</p>
                    <p class="font-semibold">{{ $artisan->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">登録日時</p>
                    <p class="font-semibold">{{ $artisan->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">更新日時</p>
                    <p class="font-semibold">{{ $artisan->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-4">
                <x-link scheme="base" :href="route('artisans.index')" button>戻る</x-link>
                <x-link scheme="scraft" :href="route('artisans.edit', $artisan)" button>編集</x-link>
                <form method="POST" action="{{ route('artisans.destroy', $artisan) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button scheme="danger" onclick="return confirm('この職人を本当に削除しますか？')">削除</x-button>
                </form>
            </div>
        </div>
    </div>
</x-layout.scraft>
