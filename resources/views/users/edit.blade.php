<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ユーザー編集') }}
            </h2>
            <a href="{{ route('users.index') }}">
                <x-secondary-button type="button">
                    {{ __('一覧に戻る') }}
                </x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- ユーザー情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">ユーザー情報</h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="name" :value="__('ユーザー名')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('メールアドレス')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="__('パスワード（変更する場合のみ入力）')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('パスワード（確認）')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('users.index') }}">
                        <x-secondary-button type="button">
                            {{ __('キャンセル') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button>
                        {{ __('更新') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

