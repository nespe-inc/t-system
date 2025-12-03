<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="color: #22c55e;">
                マスタ管理
            </h2>
            <a href="{{ route('dashboard') }}">
                <button class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-md transition-all duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('ダッシュボードに戻る') }}
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F0, #F0F0EB, #EBEBE6);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- マスタ管理カードグリッド -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- ユーザー管理カード -->
                <div class="bg-white rounded-lg shadow-md border-2 border-blue-300 hover:shadow-xl transition-all duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-100 rounded-full p-3 mr-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold" style="color: #3b82f6;">ユーザー管理</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">システムユーザーの管理</p>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold text-sm transition-colors group">
                            → 管理画面へ
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 部署管理カード -->
                <div class="bg-white rounded-lg shadow-md border-2 border-green-300 hover:shadow-xl transition-all duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 rounded-full p-3 mr-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold" style="color: #22c55e;">部署管理</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">部署情報の管理</p>
                        <p class="text-gray-400 text-sm">※準備中</p>
                    </div>
                </div>

                <!-- お知らせ管理カード -->
                <div class="bg-white rounded-lg shadow-md border-2 border-orange-300 hover:shadow-xl transition-all duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-pink-100 rounded-full p-3 mr-4">
                                <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold" style="color: #f97316;">お知らせ管理</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">お知らせの投稿・管理</p>
                        <p class="text-gray-400 text-sm">※準備中</p>
                    </div>
                </div>

                <!-- カテゴリ管理カード -->
                <div class="bg-white rounded-lg shadow-md border-2 border-pink-300 hover:shadow-xl transition-all duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-yellow-100 rounded-full p-3 mr-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold" style="color: #ec4899;">カテゴリ管理</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">相談カテゴリの管理</p>
                        <p class="text-gray-400 text-sm">※準備中</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

