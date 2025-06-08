<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-web-fonts></x-web-fonts>
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-full bg-gray-50 flex flex-col min-h-screen font-ZenKakuGothicNew">
    <div class="w-full bg-indigo-500 p-4 shadow">
        <h1 class="text-xl font-bold text-white">エス・クラフト 受発注管理システム</h1>
    </div>
    <main class="flex-grow flex">
        <section class="container mx-auto px-4 flex-grow">
            {{$slot}}
        </section>
    </main>
    <x-footer></x-footer>
</body>
</html>
