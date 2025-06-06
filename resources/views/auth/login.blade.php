<x-scraft>
    <x-slot name="title">エスクラフト受発注管理システム ログイン</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    ログイン
                </h2>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
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
                            class="@error('email') border-red-500 @enderror"
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
                            class="@error('password') border-red-500 @enderror"
                        />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                        パスワードを忘れた
                    </a>
                </div>

                <div>
                    <x-button-component :scheme="'scraft'" :label="'ログイン'"></x-button-component>
                </div>
            </form>
        </div>
    </div>
</x-scraft>