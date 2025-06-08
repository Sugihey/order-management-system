<x-layout.artisan>
    <x-slot name="title">メール確認</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    メール確認
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    登録確認のメールを送信しました
                </p>
            </div>

            <div class="mt-8 space-y-6">
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        {{ session('email') ?? 'ご登録いただいたメールアドレス' }}に確認メールを送信しました。
                        メール内のリンクをクリックして登録を完了してください。
                    </p>
                </div>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('artisan.verification.resend') }}">
                    @csrf
                    <div>
                        <x-form.label for="email" label="メールアドレス"></x-form.label>
                        <x-form.input 
                            id="email" 
                            name="email" 
                            type="email" 
                            :value="session('email') ?? old('email')"
                            required
                        />
                        @error('email')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <x-form.buttons.action
                            type="submit" 
                            label="確認メールを再送信" 
                            onClick=""
                        />
                    </div>
                </form>

                <div class="text-center">
                    <a href="{{ route('artisan.login') }}" class="text-blue-600 hover:text-blue-500">
                        ログインページに戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout.artisan>
