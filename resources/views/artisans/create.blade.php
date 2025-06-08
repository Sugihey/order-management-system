<x-layout.scraft>
    <x-slot name="title">新規職人登録</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'職人一覧','route'=>'artisans.index']]" current="新規職人登録"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規職人登録</h1>
            
            <form method="POST" action="{{ route('artisans.store') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <x-form.label for="name" label="名前" required></x-form.label>
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

                    <div>
                        <x-form.label for="phone_no" label="電話番号" required></x-form.label>
                        <x-form.input 
                            id="phone_no" 
                            name="phone_no" 
                            type="tel" 
                            :value="old('phone_no')"
                            required
                        />
                        @error('phone_no')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <div>
                        <x-form.label for="address" label="住所" required></x-form.label>
                        <x-form.input 
                            id="address" 
                            name="address" 
                            type="text" 
                            :value="old('address')"
                            required
                        />
                        @error('address')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <div>
                        <x-form.label for="email" label="メールアドレス" required></x-form.label>
                        <x-form.input 
                            id="email" 
                            name="email" 
                            type="email" 
                            :value="old('email')"
                            required
                        />
                        @error('email')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                </div>
                <div class="flext justify-items-end mt-6">
                    <div class="flex gap-4 w-[30%]">
                        <x-link scheme="base" :href="route('artisans.index')" button>キャンセル</x-link>
                        <x-button scheme="action">登録</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
