<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">管理画面</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}さん</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-500">
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">マスタ管理</h2>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">ユーザー一覧</h3>
                                <p class="text-sm text-gray-500">システムユーザーの管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">職人一覧</h3>
                                <p class="text-sm text-gray-500">職人情報の管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="{{ route('customers.index') }}" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">顧客一覧</h3>
                                <p class="text-sm text-gray-500">顧客情報の管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">請求先一覧</h3>
                                <p class="text-sm text-gray-500">請求先情報の管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">作業一覧</h3>
                                <p class="text-sm text-gray-500">作業内容の管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">作業単価一覧</h3>
                                <p class="text-sm text-gray-500">顧客別作業単価の管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">消費税率設定</h3>
                                <p class="text-sm text-gray-500">消費税率を設定します</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">受発注管理</h2>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">新規受注入力</h3>
                                <p class="text-sm text-gray-500">新しい受注の登録</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">受注一覧</h3>
                                <p class="text-sm text-gray-500">受注情報の確認・管理</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">物件別作業一覧</h3>
                                <p class="text-sm text-gray-500">物件単位で作業状況を管理します</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="block p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">見積書・請求書発行</h3>
                                <p class="text-sm text-gray-500">見積書および請求書の発行</p>
                            </div>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
