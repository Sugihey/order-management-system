<x-layout.scraft>
    <x-slot name="title">新規ユーザー登録</x-slot>

    <div class="py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規ユーザー登録</h1>
            
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-6">
                    <div class="mb-4">
                        <x-form.label for="name" label="ユーザー名"></x-form.label>
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
                    <div class="mb-4">
                        <x-form.label for="email" label="メールアドレス"></x-form.label>
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
                    <div class="mb-4">
                        <x-form.label for="password" label="パスワード"></x-form.label>
                        <x-form.input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required
                        />
                        @error('password')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <x-form.label for="password_confirmation" label="パスワード確認"></x-form.label>
                        <x-form.input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required
                        />
                    </div>
                </div>
                <div class="flext justify-items-end">
                    <div class="flex gap-4 w-[30%]">
                        <a href="{{ route('users.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-300">キャンセル</a>
                        <x-button :scheme="'scraft'">登録</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
