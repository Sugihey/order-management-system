<x-layout.scraft>
    <x-slot name="title">作業情報編集</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'作業一覧','route'=>'operations.index']]" current="作業情報編集"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">作業情報編集</h1>
            
            <form method="POST" action="{{ route('operations.update', $operation) }}">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.label for="name" label="作業名" required></x-form.label>
                            <x-form.input 
                                id="name" 
                                name="name" 
                                type="text" 
                                :value="old('name', $operation->name)"
                                required
                            />
                            @error('name')
                                <x-form.error>{{ $message }}</x-form.error>
                            @enderror
                        </div>
                        <div>
                            <x-form.label for="unit" label="単位" required></x-form.label>
                            <x-form.input 
                                id="unit" 
                                name="unit" 
                                type="text" 
                                :value="old('unit', $operation->unit)"
                                required
                                maxlength="3"
                            />
                            @error('unit')
                                <x-form.error>{{ $message }}</x-form.error>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <x-link scheme="base" :href="route('operations.index')" button>キャンセル</x-link>
                    <x-button :scheme="'action'">更新</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
