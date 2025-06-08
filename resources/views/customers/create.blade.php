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
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>
                <div class="flext justify-items-end">
                    <div class="flex gap-4 w-[30%]">
                        <x-backlink destination="customers.index">キャンセル</x-backlink>
                        <x-button :scheme="'scraft'">登録</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-scraft>
