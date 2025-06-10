<x-layout.scraft>
    <x-slot name="title">新規ユーザー登録</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'ユーザー一覧','route'=>'users.index']]" current="新規ユーザー登録"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">新規ユーザー登録</h1>
            
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-6">
                    <div class="mb-4">
                        <x-form.label for="name" label="ユーザー名" required></x-form.label>
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
                    <div class="mb-4">
                        <x-form.label for="password" label="パスワード" required></x-form.label>
                        <x-form.input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required
                            autocomplete="new-password"
                        />
                        @error('password')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <x-form.label for="password_confirmation" label="パスワード確認" required></x-form.label>
                        <x-form.input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required
                            autocomplete="new-password"
                        />
                    </div>
                </div>
                <div class="flext justify-items-end">
                    <div class="flex gap-4 w-[30%]">
                        <x-link scheme="base" :href="route('users.index')" button>キャンセル</x-link>
                        <x-button scheme="action">登録</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
