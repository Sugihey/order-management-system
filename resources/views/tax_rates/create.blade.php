<x-layout.scraft>
    <x-slot name="title">新規税率登録</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'消費税率設定','route'=>'tax-rates.index']]" current="新規税率登録"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規税率登録</h1>
            
            <form method="POST" action="{{ route('tax-rates.store') }}">
                @csrf
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-form.label for="apply_date" label="適用開始年月日" required></x-form.label>
                        <x-form.input 
                            id="apply_date" 
                            name="apply_date" 
                            type="date" 
                            :value="old('apply_date')"
                            required
                        />
                        @error('apply_date')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div>
                        <x-form.label for="rate" label="税率（%）" required></x-form.label>
                        <x-form.input 
                            id="rate" 
                            name="rate" 
                            type="number" 
                            :value="old('rate')"
                            min="0"
                            max="100"
                            required
                        />
                        @error('rate')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4">
                    <x-link scheme="base" :href="route('tax-rates.index')" button>キャンセル</x-link>
                    <x-button scheme="action">登録</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
