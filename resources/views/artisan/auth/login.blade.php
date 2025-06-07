<x-artisan>
    <x-slot name="title">エスクラフト作業管理 ログイン</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    作業管理ログイン
                </h2>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" method="POST" action="{{ route('artisan.login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-form.label for="email" label="メールアドレス"></x-label>
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
                    <x-form.label for="password" label="パスワード"></x-label>
                    <x-form.input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required
                        />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <x-link-component :scheme="'artisan'" :href="route('artisan.password.request')" :label="'パスワードを忘れた'" :class="'text-sm'" />
                </div>

                <div>
                    <x-form.buttons.artisan-component 
                        type="submit" 
                        label="ログイン" 
                        onClick=""
                    />
               </div>
            </form>
            <hr>
            <div class="text-center">
                <x-link-component :scheme="'artisan'" :href="route('artisan.register')" :label="'新規登録'" />
            </div>
        </div>
    </div>
</x-artisan>
