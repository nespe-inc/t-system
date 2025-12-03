<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('企業情報新規登録') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('companies.index') }}">
                    <x-secondary-button type="button">
                        {{ __('一覧に戻る') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('companies.store') }}" class="space-y-8">
                @csrf

                <!-- ヘッダー情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">基本情報</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="company_no" :value="__('企業NO')" />
                                <x-text-input id="company_no" class="block mt-1 w-full" type="text" name="company_no" :value="old('company_no')" />
                                <x-input-error :messages="$errors->get('company_no')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="region" :value="__('東')" />
                                <x-text-input id="region" class="block mt-1 w-full" type="text" name="region" :value="old('region')" />
                                <x-input-error :messages="$errors->get('region')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="form_date" :value="__('日付')" />
                                <x-text-input id="form_date" class="block mt-1 w-full" type="date" name="form_date" :value="old('form_date')" />
                                <x-input-error :messages="$errors->get('form_date')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 会社情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">会社情報</h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="company_name" :value="__('会社名')" />
                                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="representative" :value="__('代表者')" />
                                <x-text-input id="representative" class="block mt-1 w-full" type="text" name="representative" :value="old('representative')" />
                                <x-input-error :messages="$errors->get('representative')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="address" :value="__('住所')" />
                                <textarea id="address" name="address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="tel" :value="__('TEL')" />
                                <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" />
                                <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 関連・系列会社 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">関連・系列会社</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <x-input-label for="has_related_company" :value="__('関連・系列会社')" class="mr-4" />
                                <label class="flex items-center mr-4">
                                    <input type="radio" name="has_related_company" value="1" {{ old('has_related_company') == '1' ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">有</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_related_company" value="0" {{ old('has_related_company', '0') == '0' ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">無</span>
                                </label>
                            </div>
                            <div>
                                <x-input-label for="related_company_name" :value="__('関連・系列会社名')" />
                                <x-text-input id="related_company_name" class="block mt-1 w-full" type="text" name="related_company_name" :value="old('related_company_name')" />
                                <x-input-error :messages="$errors->get('related_company_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="related_company_address" :value="__('関連・系列会社住所')" />
                                <textarea id="related_company_address" name="related_company_address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('related_company_address') }}</textarea>
                                <x-input-error :messages="$errors->get('related_company_address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="shareholding_ratio" :value="__('持分比率')" />
                                <x-text-input id="shareholding_ratio" class="block mt-1 w-full" type="text" name="shareholding_ratio" :value="old('shareholding_ratio')" />
                                <x-input-error :messages="$errors->get('shareholding_ratio')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 合併・解散歴 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">合併・解散歴</h3>
                        <div class="flex items-center">
                            <label class="flex items-center mr-4">
                                <input type="radio" name="has_merger_dissolution" value="1" {{ old('has_merger_dissolution') == '1' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">有</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="has_merger_dissolution" value="0" {{ old('has_merger_dissolution', '0') == '0' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">無</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 採否裏書 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">採否裏書</h3>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="decision" value="採" {{ old('decision') == '採' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">採</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="decision" value="否" {{ old('decision') == '否' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">否</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="decision" value="裏書" {{ old('decision') == '裏書' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">裏書</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('companies.index') }}">
                        <x-secondary-button type="button">
                            {{ __('キャンセル') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button>
                        {{ __('登録') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

