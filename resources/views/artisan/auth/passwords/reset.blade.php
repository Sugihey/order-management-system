<x-layout.artisan>
    <x-slot name="title">エスクラフト作業管理 新しいパスワードを設定</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    新しいパスワードを設定
                </h2>
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('artisan.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <x-form.label for="email" label="メールアドレス"></x-form.label>
                    <x-form.input 
                            id="email" 
                            name="email" 
                            type="email" 
                            :value="old('email')"
                            required
                        />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-form.label for="password" label="新しいパスワード"></x-form.label>
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

                <div>
                <x-form.label for="password_confirmation" label="パスワード確認"></x-form.label>
                <x-form.input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    required
                />
                <div>
                    <x-button type="submit" scheme="action">パスワードをリセット</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout.artisan>