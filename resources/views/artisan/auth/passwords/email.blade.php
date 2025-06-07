<x-artisan>
    <x-slot name="title">エスクラフト作業管理 パスワードリセット</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    パスワードリセット
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    メールアドレスを入力してください。<br>パスワードリセットリンクをお送りします。
                </p>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" method="POST" action="{{ route('artisan.password.email') }}">
                @csrf
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
                    <x-form.buttons.artisan-component 
                        type="submit" 
                        label="パスワードリセットリンクを送信" 
                        onClick=""
                    />
                </div>

                <div class="text-center">
                    <x-link-component :scheme="'artisan'" :href="route('artisan.login')" :label="'ログイン画面に戻る'" :class="'text-sm'" />
                </div>
            </form>
        </div>
    </div>
</x-artisan>