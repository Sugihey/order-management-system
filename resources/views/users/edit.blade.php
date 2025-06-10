<x-layout.scraft>
    <x-slot name="title">ユーザー情報編集</x-slot>

    <div class="py-8">
        <x-breads scheme="scraft" :nodes="[['title'=>'ユーザー一覧','route'=>'users.index']]" current="ユーザー情報編集"/>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">ユーザー情報編集</h1>
            
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <div class="mb-4">
                        <x-form.label for="name" label="ユーザー名"></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name', $user->name)"
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
                            :value="old('email', $user->email)"
                            required
                        />
                        @error('email')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <x-form.label for="password" label="新しいパスワード（変更する場合のみ）"></x-form.label>
                        <x-form.input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password"
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
                            autocomplete="new-password"
                        />
                    </div>
                </div>
                <div class="flex gap-4">
                    <x-link scheme="base" :href="route('users.index')" button>キャンセル</x-link>
                    <x-button scheme="action">更新</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout.scraft>
