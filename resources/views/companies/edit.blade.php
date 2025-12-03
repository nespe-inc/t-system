<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('企業情報編集') }}
            </h2>
            <a href="{{ route('companies.index') }}">
                <x-secondary-button type="button">
                    {{ __('一覧に戻る') }}
                </x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('companies.update', $company) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- ヘッダー情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">基本情報</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="company_no" :value="__('企業NO')" />
                                <x-text-input id="company_no" class="block mt-1 w-full" type="text" name="company_no" :value="old('company_no', $company->company_no)" />
                                <x-input-error :messages="$errors->get('company_no')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="region" :value="__('東')" />
                                <x-text-input id="region" class="block mt-1 w-full" type="text" name="region" :value="old('region', $company->region)" />
                                <x-input-error :messages="$errors->get('region')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="form_date" :value="__('日付')" />
                                <x-text-input id="form_date" class="block mt-1 w-full" type="date" name="form_date" :value="old('form_date', $company->form_date ? $company->form_date->format('Y-m-d') : '')" />
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
                                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $company->company_name)" />
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="representative" :value="__('代表者')" />
                                <x-text-input id="representative" class="block mt-1 w-full" type="text" name="representative" :value="old('representative', $company->representative)" />
                                <x-input-error :messages="$errors->get('representative')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="address" :value="__('住所')" />
                                    <textarea id="address" name="address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('address', $company->address) }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="tel" :value="__('TEL')" />
                                <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel', $company->tel)" />
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
                                    <input type="radio" name="has_related_company" value="1" {{ old('has_related_company', $company->has_related_company) == '1' ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">有</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="has_related_company" value="0" {{ old('has_related_company', $company->has_related_company ? '1' : '0') == '0' ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">無</span>
                                </label>
                            </div>
                            <div>
                                <x-input-label for="related_company_name" :value="__('関連・系列会社名')" />
                                <x-text-input id="related_company_name" class="block mt-1 w-full" type="text" name="related_company_name" :value="old('related_company_name', $company->related_company_name)" />
                                <x-input-error :messages="$errors->get('related_company_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="related_company_address" :value="__('関連・系列会社住所')" />
                                    <textarea id="related_company_address" name="related_company_address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('related_company_address', $company->related_company_address) }}</textarea>
                                <x-input-error :messages="$errors->get('related_company_address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="shareholding_ratio" :value="__('持分比率')" />
                                <x-text-input id="shareholding_ratio" class="block mt-1 w-full" type="text" name="shareholding_ratio" :value="old('shareholding_ratio', $company->shareholding_ratio)" />
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
                                    <input type="radio" name="has_merger_dissolution" value="1" {{ old('has_merger_dissolution', $company->has_merger_dissolution) == '1' ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700 dark:text-gray-300">有</span>
                            </label>
                            <label class="flex items-center">
                                    <input type="radio" name="has_merger_dissolution" value="0" {{ old('has_merger_dissolution', $company->has_merger_dissolution ? '1' : '0') == '0' ? 'checked' : '' }} class="mr-2">
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

                <!-- 調査履歴 -->
                @include('companies.partials.investigations', ['type' => 'teikoku', 'label' => '帝国', 'company' => $company])
                @include('companies.partials.investigations', ['type' => 'tosho', 'label' => '東商', 'company' => $company])
                @include('companies.partials.investigations-simple', ['type' => 'seni', 'label' => '繊維', 'company' => $company])
                @include('companies.partials.investigations-simple', ['type' => 'kensetsu', 'label' => '建設', 'company' => $company])

                <!-- 否理由 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">否理由</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $rejectionReasons = [
                                    1 => '手形出回る',
                                    2 => '興信所不評',
                                    3 => '不渡歴有り',
                                    4 => '成因不審',
                                    5 => '内容不詳',
                                    6 => '財務軟弱',
                                    7 => '金額大',
                                    8 => '当社裏',
                                    9 => '他社裏',
                                    10 => '振出人反社',
                                    11 => '依頼人悪質',
                                    12 => '不動産悪し',
                                    13 => '系列会社悪し',
                                    14 => '条件合わず',
                                    15 => 'サイト長・短',
                                    16 => 'その他',
                                ];
                            @endphp
                            @foreach($rejectionReasons as $key => $reason)
                                <label class="flex items-center">
                                    <input type="checkbox" name="rejection_reasons[]" value="{{ $key }}" {{ in_array($key, old('rejection_reasons', $company->rejection_reasons ?? [])) ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $key }}. {{ $reason }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if(in_array(14, old('rejection_reasons', $company->rejection_reasons ?? [])))
                            <div class="mt-4">
                                <x-input-label for="rejection_rate" :value="__('希望レート・当社レート')" />
                                <div class="flex items-center space-x-2 mt-1">
                                    <x-text-input id="rejection_rate" class="block w-32" type="text" name="rejection_rate" :value="old('rejection_rate')" placeholder="希望レート" />
                                    <span class="text-gray-700 dark:text-gray-300">/</span>
                                    <x-text-input class="block w-32" type="text" name="rejection_rate_company" :value="old('rejection_rate_company')" placeholder="当社レート" />
                                </div>
                            </div>
                        @endif
                        <div class="mt-4">
                            <x-input-label for="rejection_comment" :value="__('コメント')" />
                                    <textarea id="rejection_comment" name="rejection_comment" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('rejection_comment', $company->rejection_comment) }}</textarea>
                            <x-input-error :messages="$errors->get('rejection_comment')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- 金額・期日・手形情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">金額・期日・手形情報</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="amount" :value="__('金額 (¥)')" />
                                <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="old('amount', $company->amount)" />
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('期日')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date', $company->due_date ? $company->due_date->format('Y-m-d') : '')" />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="bill_no" :value="__('手形 No.')" />
                                <x-text-input id="bill_no" class="block mt-1 w-full" type="text" name="bill_no" :value="old('bill_no', $company->bill_no)" />
                                <x-input-error :messages="$errors->get('bill_no')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="bank_branch" :value="__('銀行 支店')" />
                                <x-text-input id="bank_branch" class="block mt-1 w-full" type="text" name="bank_branch" :value="old('bank_branch', $company->bank_branch)" />
                                <x-input-error :messages="$errors->get('bank_branch')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="first_endorsement" :value="__('1裏')" />
                                <x-text-input id="first_endorsement" class="block mt-1 w-full" type="text" name="first_endorsement" :value="old('first_endorsement', $company->first_endorsement)" />
                                <x-input-error :messages="$errors->get('first_endorsement')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="second_endorsement" :value="__('2裏')" />
                                <x-text-input id="second_endorsement" class="block mt-1 w-full" type="text" name="second_endorsement" :value="old('second_endorsement', $company->second_endorsement)" />
                                <x-input-error :messages="$errors->get('second_endorsement')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 依頼人情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">依頼人情報</h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label :value="__('依頼人')" />
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="A" {{ old('client_type', $company->client_type) == 'A' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">A</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="旧A" {{ old('client_type', $company->client_type) == '旧A' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">旧A</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="B" {{ old('client_type', $company->client_type) == 'B' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">B</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="その他" {{ old('client_type', $company->client_type) == 'その他' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">その他</span>
                                    </label>
                                    <x-text-input class="block w-32" type="text" name="client_other" :value="old('client_other', $company->client_other)" placeholder="その他の場合" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="client_company_name" :value="__('依頼人会社名')" />
                                    <x-text-input id="client_company_name" class="block mt-1 w-full" type="text" name="client_company_name" :value="old('client_company_name', $company->client_company_name)" />
                                    <x-input-error :messages="$errors->get('client_company_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_address" :value="__('依頼人住所')" />
                                    <textarea id="client_address" name="client_address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('client_address', $company->client_address) }}</textarea>
                                    <x-input-error :messages="$errors->get('client_address')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_representative" :value="__('依頼人代表者')" />
                                    <x-text-input id="client_representative" class="block mt-1 w-full" type="text" name="client_representative" :value="old('client_representative', $company->client_representative)" />
                                    <x-input-error :messages="$errors->get('client_representative')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_tel" :value="__('依頼人TEL')" />
                                    <x-text-input id="client_tel" class="block mt-1 w-full" type="text" name="client_tel" :value="old('client_tel', $company->client_tel)" />
                                    <x-input-error :messages="$errors->get('client_tel')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 担当者情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">担当者情報</h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="person_in_charge_opinion" :value="__('担当者意見')" />
                                <textarea id="person_in_charge_opinion" name="person_in_charge_opinion" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('person_in_charge_opinion', $company->person_in_charge_opinion) }}</textarea>
                                <x-input-error :messages="$errors->get('person_in_charge_opinion')" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="person_in_charge" :value="__('担当者')" />
                                    <x-text-input id="person_in_charge" class="block mt-1 w-full" type="text" name="person_in_charge" :value="old('person_in_charge', $company->person_in_charge)" />
                                    <x-input-error :messages="$errors->get('person_in_charge')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="sales_representative" :value="__('営業担当')" />
                                    <x-text-input id="sales_representative" class="block mt-1 w-full" type="text" name="sales_representative" :value="old('sales_representative', $company->sales_representative)" />
                                    <x-input-error :messages="$errors->get('sales_representative')" class="mt-2" />
                                </div>
                            </div>
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
                        {{ __('更新') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

