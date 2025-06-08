<x-layout.scraft>
    <x-slot name="title">作業情報</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'作業一覧','route'=>'operations.index']]" current="作業情報"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">作業情報</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600">作業名</p>
                    <p class="font-semibold">{{ $operation->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">単位</p>
                    <p class="font-semibold">{{ $operation->unit }}</p>
                </div>
                <div>
                    <p class="text-gray-600">並び順</p>
                    <p class="font-semibold">{{ $operation->sort }}</p>
                </div>
                <div>
                    <p class="text-gray-600">登録日時</p>
                    <p class="font-semibold">{{ $operation->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">更新日時</p>
                    <p class="font-semibold">{{ $operation->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-4">
                <x-link scheme="base" :href="route('operations.index')" button>戻る</x-link>
                <x-link scheme="scraft" :href="route('operations.edit', $operation)" button>編集</x-link>
                <form method="POST" action="{{ route('operations.destroy', $operation) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button scheme="danger" onclick="return confirm('この作業を本当に削除しますか？')">削除</x-button>
                </form>
            </div>
        </div>
    </div>
</x-layout.scraft>
