<x-layout.scraft>
    <x-slot name="title">消費税率設定</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" current="消費税率設定"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">消費税率設定</h1>
                <x-link scheme="scraft" :href="route('tax-rates.create')" button>新規税率登録</x-link>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">適用開始年月日</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">税率</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[200px]">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($taxRates as $taxRate)
                            <tr>
                                <td class="px-6 py-4">{{ $taxRate->apply_date->format('Y年m月d日') }}</td>
                                <td class="px-6 py-4">{{ $taxRate->rate }}%</td>
                                <td class="px-6 py-4 space-x-2">
                                    <x-link scheme="action" :href="route('tax-rates.edit', $taxRate)" button>編集</x-link>
                                    <form method="POST" action="{{ route('tax-rates.destroy', $taxRate) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button scheme="danger" onclick="return confirm('税率「{{ $taxRate->rate }}%（{{ $taxRate->apply_date->format('Y年m月d日') }}適用）」を本当に削除しますか？')">削除</x-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">消費税率が登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.scraft>
