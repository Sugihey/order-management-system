<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-full bg-gray-50 flex flex-col min-h-screen">
    <div class="w-full bg-white p-4 shadow">
        <h1 class="text-xl">エス・クラフト 受発注管理システム</h1>
    </div>
    <main class="flex-grow flex">
        <section class="container mx-auto px-4 flex-grow">
            {{$slot}}
        </section>
    </main>
    <footer class="bg-gray-200">
        <p class="p-2 text-center text-xs">Copyright © 2025 Scraft, inc. All Rights Reserved.</p>
    </footer>
</body>
</html>
