<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F0, #F0F0EB, #EBEBE6);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ヒーローセクション -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">ダッシュボード</h1>
                <p class="text-gray-600">システム管理画面へようこそ</p>
            </div>

            <!-- 企業情報カード -->
            <div class="overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-orange-500 hover:shadow-2xl hover:border-orange-600 transition-all duration-200 mb-6" style="background: linear-gradient(to bottom right, #fff7ed, #ffedd5);">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-orange-500 rounded-full p-3 mr-4 shadow-lg ring-4 ring-orange-100">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                        {{ __('企業情報管理') }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ __('企業情報の登録・編集・閲覧ができます') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('companies.index') }}" class="block mt-4">
                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-md transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            {{ __('企業情報一覧へ') }}
                        </button>
                    </a>
                </div>
            </div>

            <!-- 追加のカードセクション（将来の拡張用） -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- カード1 -->
                <div class="overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-blue-500 hover:shadow-2xl hover:border-blue-600 transition-all duration-200" style="background: linear-gradient(to bottom right, #dbeafe, #bfdbfe);">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-500 rounded-full p-3 mr-3 shadow-lg ring-4 ring-blue-100">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">システム管理</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">システム設定や管理機能にアクセスできます</p>
                        <a href="{{ route('systems.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors group">
                            詳細を見る 
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- カード2 -->
                <div class="overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-500 hover:shadow-2xl hover:border-green-600 transition-all duration-200" style="background: linear-gradient(to bottom right, #dcfce7, #bbf7d0);">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-500 rounded-full p-3 mr-3 shadow-lg ring-4 ring-green-100">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">統計情報</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">データの統計やレポートを確認できます</p>
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold text-sm transition-colors group">
                            詳細を見る 
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
