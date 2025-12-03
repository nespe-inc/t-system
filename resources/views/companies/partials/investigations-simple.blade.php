<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ $label }}調査履歴</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">年</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">有無</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @for($i = 0; $i < 3; $i++)
                        <tr>
                            @php
                                // 新しいテーブル構造では、情報登録フォームでは既存データを表示しない
                                $inv = [];
                            @endphp
                            <td class="px-4 py-3 whitespace-nowrap">
                                <x-text-input class="block w-24" type="text" name="{{ $type }}_year_{{$i}}" :value="old($type . '_year_' . $i, $inv['year'] ?? '')" placeholder="年" />
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_has_{{$i}}" value="1" {{ old($type . '_has_' . $i, $inv['has'] ?? false) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">有</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="{{ $type }}_no_{{$i}}" value="1" {{ old($type . '_no_' . $i, !($inv['has'] ?? false)) ? 'checked' : '' }} class="mr-1">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">無</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

