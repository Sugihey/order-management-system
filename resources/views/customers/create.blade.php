<x-scraft>
    <x-slot name="title">新規顧客登録</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規顧客登録</h1>
            
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="mb-6">
                    <div>
                        <x-form.label for="name" label="顧客名"></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name')"
                            required
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flext justify-items-end">
                    <div class="flex gap-4 w-[30%]">
                        <a href="{{ route('customers.index') }}" class="w-full bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 text-center">キャンセル</a>
                        <x-button-component :scheme="'scraft'" :label="'登録'"></x-button-component>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-scraft>
