<x-scraft>
    <x-slot name="title">新規顧客登録</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規顧客登録</h1>
            
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-form.label for="name" label="名前"></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name')"
                            required
                            class="@error('name') border-red-500 @enderror"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <x-form.label for="sort" label="並び順"></x-form.label>
                        <x-form.input 
                            id="sort" 
                            name="sort" 
                            type="number" 
                            :value="old('sort', 0)"
                            required
                            class="@error('sort') border-red-500 @enderror"
                        />
                        @error('sort')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">キャンセル</a>
                    <x-button-component :scheme="'scraft'" :label="'登録'"></x-button-component>
                </div>
            </form>
        </div>
    </div>
</x-scraft>
