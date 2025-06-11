<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-web-fonts></x-web-fonts>
    <title>{{$title}}</title>
    <style>
        /* Hide spinner for number input */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-full bg-gray-50 flex flex-col min-h-screen font-ZenKakuGothicNew">
    <div class="flex justify-between items-center mb-8 bg-indigo-500 py-2 px-4">
        <h1 class="text-lg md:text-xl font-bold text-white">受発注管理システム</h1>
        <div class="flex items-center space-x-4">
        @if(Auth::user())
            <span class="text-white text-sm md:text-base">{{ Auth::user()->name }}さん</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <x-button scheme="base">ログアウト</x-button>
            </form>
        @endif
        </div>
    </div>

    <main class="flex-grow flex">
        <section class="container mx-auto px-4 flex-grow">
            {{$slot}}
        </section>
    </main>
    <x-footer></x-footer>
</body>
</html>
