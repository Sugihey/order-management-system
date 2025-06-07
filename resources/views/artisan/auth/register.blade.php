<x-artisan>
    <x-slot name="title">エスクラフト作業管理 新規登録</x-slot>

    <div class="h-full flex items-center justify-center">
        <div class="max-w-2xl w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    新規登録
                </h2>
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('artisan.register') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-form.label for="name" label="名前"></x-form.label>
                        <x-form.input 
                            id="name" 
                            name="name" 
                            type="text" 
                            :value="old('name')"
                            required
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-form.label for="address" label="住所"></x-form.label>
                        <x-form.input 
                            id="address" 
                            name="address" 
                            type="text" 
                            :value="old('address')"
                            required
                        />
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-form.label for="phone_no" label="電話番号"></x-form.label>
                        <x-form.input 
                            id="phone_no" 
                            name="phone_no" 
                            type="tel" 
                            :value="old('phone_no')"
                            required
                        />
                        @error('phone_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                        <x-form.label for="password" label="パスワード"></x-form.label>
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

                    <div>
                        <x-form.label for="password_confirmation" label="パスワード確認"></x-form.label>
                        <x-form.input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required
                        />
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <x-form.buttons.base-component 
                        type="button" 
                        label="キャンセル" 
                        onClick="window.location.href='{{ route('artisan.login') }}'"
                    />
                    <x-form.buttons.action-component 
                        type="submit" 
                        label="登録" 
                        onClick=""
                    />
                </div>
            </form>
        </div>
    </div>
</x-artisan>
