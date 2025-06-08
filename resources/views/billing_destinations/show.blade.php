<x-layout.scraft>
    <x-slot name="title">請求先詳細</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'請求先一覧','route'=>'billing_destinations.index']]" current="請求先詳細"/>
            <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">請求先詳細</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <x-form.label for="customer" label="顧客"></x-form.label>
                    <div class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                        {{ $billingDestination->customer->name }}
                    </div>
                </div>
                <div>
                    <x-form.label for="name" label="請求先名称"></x-form.label>
                    <div class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                        {{ $billingDestination->name }}
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-2 flex gap-4 mb-6">
                <div>
                    <x-form.label for="due_day" label="締め日"></x-form.label>
                    <div class="mt-1 block w-auto px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                        {{ $billingDestination->due_day == 31 ? '31日(月末)' : $billingDestination->due_day . '日' }}
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-bold mb-4">物件情報</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">物件名</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">住所</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($billingDestination->properties as $property)
                                <tr>
                                    <td class="px-6 py-4">{{ $property->name }}</td>
                                    <td class="px-6 py-4">{{ $property->address }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">物件が登録されていません。</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex gap-4">
                <x-link scheme="base" :href="route('billing_destinations.index')" button>戻る</x-link>
                <x-link scheme="action" :href="route('billing_destinations.edit', $billingDestination)" button>編集</x-link>
            </div>
        </div>
    </div>
</x-layout.scraft>
