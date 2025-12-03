<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ $label }}調査履歴</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">調査日</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">決算年月</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">決算書</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">不動産</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">調査履歴</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @for($i = 0; $i < 4; $i++)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @php
                                        // 新しいテーブル構造では、情報登録フォームでは既存データを表示しない
                                        $inv = [];
                                    @endphp
                                    <x-text-input class="block w-20" type="text" name="{{ $type }}_investigation_date_year_{{$i}}" :value="old($type . '_investigation_date_year_' . $i, $inv['investigation_date_year'] ?? '')" placeholder="年" />
                                    <span class="text-gray-700 dark:text-gray-300">/</span>
                                    <x-text-input class="block w-20" type="text" name="{{ $type }}_investigation_date_point_{{$i}}" :value="old($type . '_investigation_date_point_' . $i, $inv['investigation_date_point'] ?? '')" placeholder="点" />
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <x-text-input class="block w-20" type="text" name="{{ $type }}_settlement_year_{{$i}}" :value="old($type . '_settlement_year_' . $i, $inv['settlement_year'] ?? '')" placeholder="年" />
                                    <span class="text-gray-700 dark:text-gray-300">/</span>
                                    <x-text-input class="block w-20" type="text" name="{{ $type }}_settlement_month_{{$i}}" :value="old($type . '_settlement_month_' . $i, $inv['settlement_month'] ?? '')" placeholder="月" />
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_financial_statement_public_{{$i}}" value="1" {{ old($type . '_financial_statement_public_' . $i, $inv['financial_statement_public'] ?? false) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">公</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_financial_statement_nonpublic_{{$i}}" value="1" {{ old($type . '_financial_statement_nonpublic_' . $i, !($inv['financial_statement_public'] ?? false)) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">非</span>
                                    </label>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_has_real_estate_{{$i}}" value="1" {{ old($type . '_has_real_estate_' . $i, $inv['has_real_estate'] ?? false) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">有</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_no_real_estate_{{$i}}" value="1" {{ old($type . '_no_real_estate_' . $i, !($inv['has_real_estate'] ?? false)) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">無</span>
                                    </label>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-1">
                                    @for($j = 0; $j < 4; $j++)
                                        <x-text-input class="block w-16" type="text" name="{{ $type }}_history_year_{{$j}}_{{$i}}" :value="old($type . '_history_year_' . $j . '_' . $i, $inv['history_years'][$j] ?? '')" placeholder="年" />
                                        @if($j < 3)
                                            <span class="text-gray-700 dark:text-gray-300">/</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

