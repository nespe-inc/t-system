<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('追加情報登録') }} - {{ $company->company_name }}
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
            <form method="POST" action="{{ route('companies.store-info', $company) }}" class="space-y-8">
                @csrf

                <!-- 調査履歴選択 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">調査履歴選択</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="investigation_type" id="check-teikoku" class="investigation-radio mr-2" data-target="investigation-teikoku" value="teikoku" checked>
                                <span class="text-gray-700 dark:text-gray-300">帝国調査履歴</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="investigation_type" id="check-tosho" class="investigation-radio mr-2" data-target="investigation-tosho" value="tosho">
                                <span class="text-gray-700 dark:text-gray-300">東商調査履歴</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="investigation_type" id="check-seni" class="investigation-radio mr-2" data-target="investigation-seni" value="seni">
                                <span class="text-gray-700 dark:text-gray-300">繊維調査履歴</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="investigation_type" id="check-kensetsu" class="investigation-radio mr-2" data-target="investigation-kensetsu" value="kensetsu">
                                <span class="text-gray-700 dark:text-gray-300">建設調査履歴</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 調査履歴 -->
                <div id="investigation-teikoku" class="investigation-form">
                    @include('companies.partials.investigations', ['type' => 'teikoku', 'label' => '帝国', 'company' => $company])
                </div>
                <div id="investigation-tosho" class="investigation-form">
                    @include('companies.partials.investigations', ['type' => 'tosho', 'label' => '東商', 'company' => $company])
                </div>
                <div id="investigation-seni" class="investigation-form">
                    @include('companies.partials.investigations-simple', ['type' => 'seni', 'label' => '繊維', 'company' => $company])
                </div>
                <div id="investigation-kensetsu" class="investigation-form">
                    @include('companies.partials.investigations-simple', ['type' => 'kensetsu', 'label' => '建設', 'company' => $company])
                </div>

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
                                $oldRejectionReasons = old('rejection_reasons', []);
                                // 配列であることを確認
                                if (!is_array($oldRejectionReasons)) {
                                    $oldRejectionReasons = [];
                                }
                            @endphp
                            @foreach($rejectionReasons as $key => $reason)
                                <label class="flex items-center">
                                    <input type="checkbox" name="rejection_reasons[]" value="{{ $key }}" {{ in_array($key, $oldRejectionReasons) ? 'checked' : '' }} class="mr-2">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $key }}. {{ $reason }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if(is_array($oldRejectionReasons) && in_array(14, $oldRejectionReasons))
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
                            <textarea id="rejection_comment" name="rejection_comment" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('rejection_comment') }}</textarea>
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
                                <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" :value="old('amount')" />
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('期日')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="bill_no" :value="__('手形 No.')" />
                                <x-text-input id="bill_no" class="block mt-1 w-full" type="text" name="bill_no" :value="old('bill_no')" />
                                <x-input-error :messages="$errors->get('bill_no')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="bank_branch" :value="__('銀行 支店')" />
                                <x-text-input id="bank_branch" class="block mt-1 w-full" type="text" name="bank_branch" :value="old('bank_branch')" />
                                <x-input-error :messages="$errors->get('bank_branch')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="first_endorsement" :value="__('1裏')" />
                                <x-text-input id="first_endorsement" class="block mt-1 w-full" type="text" name="first_endorsement" :value="old('first_endorsement')" />
                                <x-input-error :messages="$errors->get('first_endorsement')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="second_endorsement" :value="__('2裏')" />
                                <x-text-input id="second_endorsement" class="block mt-1 w-full" type="text" name="second_endorsement" :value="old('second_endorsement')" />
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
                                        <input type="radio" name="client_type" value="A" {{ old('client_type') == 'A' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">A</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="旧A" {{ old('client_type') == '旧A' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">旧A</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="B" {{ old('client_type') == 'B' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">B</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="client_type" value="その他" {{ old('client_type') == 'その他' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-gray-700 dark:text-gray-300">その他</span>
                                    </label>
                                    <x-text-input class="block w-32" type="text" name="client_other" :value="old('client_other')" placeholder="その他の場合" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="client_company_name" :value="__('依頼人会社名')" />
                                    <x-text-input id="client_company_name" class="block mt-1 w-full" type="text" name="client_company_name" :value="old('client_company_name')" />
                                    <x-input-error :messages="$errors->get('client_company_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_address" :value="__('依頼人住所')" />
                                    <textarea id="client_address" name="client_address" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('client_address') }}</textarea>
                                    <x-input-error :messages="$errors->get('client_address')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_representative" :value="__('依頼人代表者')" />
                                    <x-text-input id="client_representative" class="block mt-1 w-full" type="text" name="client_representative" :value="old('client_representative')" />
                                    <x-input-error :messages="$errors->get('client_representative')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="client_tel" :value="__('依頼人TEL')" />
                                    <x-text-input id="client_tel" class="block mt-1 w-full" type="text" name="client_tel" :value="old('client_tel')" />
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
                                <textarea id="person_in_charge_opinion" name="person_in_charge_opinion" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('person_in_charge_opinion') }}</textarea>
                                <x-input-error :messages="$errors->get('person_in_charge_opinion')" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="person_in_charge" :value="__('担当者')" />
                                    <x-text-input id="person_in_charge" class="block mt-1 w-full" type="text" name="person_in_charge" :value="old('person_in_charge')" />
                                    <x-input-error :messages="$errors->get('person_in_charge')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="sales_representative" :value="__('営業担当')" />
                                    <x-text-input id="sales_representative" class="block mt-1 w-full" type="text" name="sales_representative" :value="old('sales_representative')" />
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
                        {{ __('登録') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('.investigation-radio');
            const allForms = document.querySelectorAll('.investigation-form');
            
            // 全てのフォームを非表示にする関数
            function hideAllForms() {
                allForms.forEach(function(form) {
                    form.style.display = 'none';
                });
            }
            
            // 選択されたラジオボタンに対応するフォームを表示
            function showSelectedForm() {
                const selectedRadio = document.querySelector('.investigation-radio:checked');
                if (selectedRadio) {
                    const targetId = selectedRadio.getAttribute('data-target');
                    const targetForm = document.getElementById(targetId);
                    if (targetForm) {
                        targetForm.style.display = 'block';
                    }
                }
            }
            
            radios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    hideAllForms();
                    showSelectedForm();
                });
            });
            
            // 初期状態を設定
            hideAllForms();
            showSelectedForm();
        });
    </script>
</x-app-layout>

