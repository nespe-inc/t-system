<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('システム編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('systems.update', $system) }}">
                        @csrf
                        @method('PUT')

                        <!-- システム名 -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('システム名')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $system->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- 説明 -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('説明')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $system->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- ステータス -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('ステータス')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="active" {{ old('status', $system->status) === 'active' ? 'selected' : '' }}>有効</option>
                                <option value="inactive" {{ old('status', $system->status) === 'inactive' ? 'selected' : '' }}>無効</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('systems.index') }}" class="mr-4">
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
        </div>
    </div>
</x-app-layout>

