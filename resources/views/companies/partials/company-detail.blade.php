<!-- 基本情報 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            基本情報
        </h3>
        <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">企業NO</dt>
                <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $company->company_no ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">東</dt>
                <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $company->region ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">日付</dt>
                <dd class="mt-1.5 text-sm font-medium text-gray-900 dark:text-gray-100">
                    @if($company->form_date)
                        @php
                            $formDate = is_string($company->form_date) ? \Carbon\Carbon::parse($company->form_date) : $company->form_date;
                        @endphp
                        {{ $formDate->format('Y年m月d日') }}
                    @else
                        -
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>

<!-- 会社情報 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            会社情報
        </h3>
        <dl class="space-y-3">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border-l-4 border-green-500 dark:border-green-400">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">会社名</dt>
                <dd class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $company->company_name ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">代表者</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->representative ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">住所</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->address ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">TEL</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->tel ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>

<!-- 関連・系列会社 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            関連・系列会社
        </h3>
        <dl class="space-y-3">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">関連・系列会社</dt>
                <dd class="mt-1.5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $company->has_related_company ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $company->has_related_company ? '有' : '無' }}
                    </span>
                </dd>
            </div>
            @if($company->has_related_company)
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">関連・系列会社名</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->related_company_name ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">関連・系列会社住所</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->related_company_address ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">持分比率</dt>
                    <dd class="text-sm font-semibold text-purple-600 dark:text-purple-400">{{ $company->shareholding_ratio ?? '-' }}</dd>
                </div>
            @endif
        </dl>
    </div>
</div>

<!-- 合併・解散歴 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            合併・解散歴
        </h3>
        <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $company->has_merger_dissolution ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                {{ $company->has_merger_dissolution ? '有' : '無' }}
            </span>
        </div>
    </div>
</div>

<!-- 採否裏書 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            採否裏書
        </h3>
        <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium {{ $company->decision === '採' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : ($company->decision === '否' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                {{ $company->decision ?? '-' }}
            </span>
        </div>
    </div>
</div>

<!-- 調査履歴 -->
@if(is_array($company->teikoku_investigations) && count($company->teikoku_investigations) > 0)
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
        <div class="p-5">
            <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                <svg class="w-5 h-5 mr-2 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                帝国調査履歴
            </h3>
            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">調査日</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">決算年月</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">決算書</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">不動産</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">調査履歴</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($company->teikoku_investigations as $inv)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $inv['investigation_date_year'] ?? '' }}/{{ $inv['investigation_date_point'] ?? '' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $inv['settlement_year'] ?? '' }}/{{ $inv['settlement_month'] ?? '' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $inv['financial_statement_public'] ?? false ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $inv['financial_statement_public'] ?? false ? '公' : '非' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $inv['has_real_estate'] ?? false ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $inv['has_real_estate'] ?? false ? '有' : '無' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                    {{ implode('/', array_filter($inv['history_years'] ?? [])) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<!-- 否理由 -->
@if($company->rejection_reasons || $company->rejection_comment)
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-red-200 dark:border-red-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
        <div class="p-5">
            <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                否理由
            </h3>
            @if($company->rejection_reasons)
                <div class="mb-4 bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">選択項目</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($company->rejection_reasons as $reason)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                {{ $reason }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($company->rejection_comment)
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">コメント</p>
                    <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap leading-relaxed">{{ $company->rejection_comment }}</p>
                </div>
            @endif
        </div>
    </div>
@endif

<!-- 金額・期日・手形情報 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            金額・期日・手形情報
        </h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border-l-4 border-yellow-500 dark:border-yellow-400">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">金額 (¥)</dt>
                <dd class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $company->amount ? number_format($company->amount) : '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">期日</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">
                    @if($company->due_date)
                        @php
                            $dueDate = is_string($company->due_date) ? \Carbon\Carbon::parse($company->due_date) : $company->due_date;
                        @endphp
                        {{ $dueDate->format('Y年m月d日') }}
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">手形 No.</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->bill_no ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">銀行 支店</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->bank_branch ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">1裏</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->first_endorsement ?? '-' }}</dd>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">2裏</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->second_endorsement ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>

<!-- 依頼人情報 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            依頼人情報
        </h3>
        <dl class="space-y-3">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border-l-4 border-teal-500 dark:border-teal-400">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">依頼人</dt>
                <dd class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                    {{ $company->client_type ?? '-' }}
                    @if($company->client_type === 'その他' && $company->client_other)
                        <span class="text-gray-600 dark:text-gray-400">({{ $company->client_other }})</span>
                    @endif
                </dd>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">依頼人会社名</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->client_company_name ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">依頼人住所</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->client_address ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">依頼人代表者</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->client_representative ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">依頼人TEL</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->client_tel ?? '-' }}</dd>
                </div>
            </div>
        </dl>
    </div>
</div>

<!-- 担当者情報 -->
<div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="p-5">
        <h3 class="text-base font-semibold mb-4 text-gray-900 dark:text-gray-100 flex items-center">
            <svg class="w-5 h-5 mr-2 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            担当者情報
        </h3>
        <dl class="space-y-3">
            <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">担当者意見</dt>
                <dd class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap leading-relaxed">{{ $company->person_in_charge_opinion ?? '-' }}</dd>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">担当者</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->person_in_charge ?? '-' }}</dd>
                </div>
                <div class="bg-white dark:bg-gray-800/50 rounded-md p-3 border border-gray-100 dark:border-gray-700">
                    <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">営業担当</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $company->sales_representative ?? '-' }}</dd>
                </div>
            </div>
        </dl>
    </div>
</div>

