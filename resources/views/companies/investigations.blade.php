<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('調査一覧') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('companies.add-info', $company) }}">
                    <x-primary-button type="button">
                        {{ __('情報登録') }}
                    </x-primary-button>
                </a>
                <a href="{{ route('companies.index') }}">
                    <x-secondary-button type="button">
                        {{ __('企業一覧に戻る') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 dark:border-green-400 text-green-800 dark:text-green-200 px-4 py-3 rounded-r-lg shadow-sm flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-3 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

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

                // テーブル行データを準備
                $tableRows = [];

                // 各情報登録レコードを処理
                foreach ($investigations as $investigation) {
                    // 否理由の表示用テキストを生成
                    $rejectionReasonsText = '';
                    if ($investigation->rejection_reasons && count($investigation->rejection_reasons) > 0) {
                        $rejectionLabels = [];
                        foreach ($investigation->rejection_reasons as $reason) {
                            $rejectionLabels[] = $reason . '. ' . ($rejectionReasons[$reason] ?? $reason);
                        }
                        $rejectionReasonsText = implode(', ', $rejectionLabels);
                    }
                    if ($investigation->rejection_comment) {
                        if ($rejectionReasonsText) {
                            $rejectionReasonsText .= ' / ' . $investigation->rejection_comment;
                        } else {
                            $rejectionReasonsText = $investigation->rejection_comment;
                        }
                    }

                    // 選択された調査履歴を判定（データが存在する最初の調査履歴）
                    $selectedInvestigationType = null;
                    $investigationInfo = '-';
                    
                    if ($investigation->teikoku_investigations && count($investigation->teikoku_investigations) > 0) {
                        $selectedInvestigationType = 'teikoku';
                        $investigationInfo = '帝国調査履歴';
                    } elseif ($investigation->tosho_investigations && count($investigation->tosho_investigations) > 0) {
                        $selectedInvestigationType = 'tosho';
                        $investigationInfo = '東商調査履歴';
                    } elseif ($investigation->seni_investigations && count($investigation->seni_investigations) > 0) {
                        $selectedInvestigationType = 'seni';
                        $investigationInfo = '繊維調査履歴';
                    } elseif ($investigation->kensetsu_investigations && count($investigation->kensetsu_investigations) > 0) {
                        $selectedInvestigationType = 'kensetsu';
                        $investigationInfo = '建設調査履歴';
                    }

                    // 調査履歴が存在する場合、または他の情報がある場合に1行表示
                    if ($selectedInvestigationType || $rejectionReasonsText || $investigation->amount || $investigation->due_date || $investigation->client_company_name || $investigation->person_in_charge) {
                        $tableRows[] = [
                            'investigation_obj' => $investigation,
                            'investigation' => $investigationInfo,
                            'investigation_type' => $selectedInvestigationType,
                            'rejection_reason' => $rejectionReasonsText,
                            'amount' => $investigation->amount ? number_format($investigation->amount) : '-',
                            'due_date' => $investigation->due_date ? $investigation->due_date->format('Y年m月d日') : '-',
                            'client' => $investigation->client_company_name ?? '-',
                            'person_in_charge' => $investigation->person_in_charge ?? '-',
                        ];
                    }
                }
            @endphp

            @if(count($tableRows) > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-0 flex-shrink-0">{{ $company->company_name }}</h3>
                            <button 
                                type="button"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'company-detail-modal')"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-150 flex-shrink-0"
                            >
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                会社詳細
                            </button>
                        </div>
                        
                        <!-- タブ切り替え -->
                        <div x-data="{ activeTab: 'current' }" x-init="console.log('Alpine.js initialized, activeTab:', activeTab)">
                            <!-- タブ切り替えボタン -->
                            <div class="mb-4">
                                <div class="flex space-x-2 border-b border-gray-200 dark:border-gray-700">
                                    <button
                                        type="button"
                                        x-on:click="activeTab = 'current'; console.log('activeTab changed to:', activeTab)"
                                        :class="activeTab === 'current' 
                                            ? 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 font-medium' 
                                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                                        class="px-4 py-2 text-sm transition-colors duration-150"
                                    >
                                        調査一覧
                                    </button>
                                    <button
                                        type="button"
                                        x-on:click="activeTab = 'past'; console.log('activeTab changed to:', activeTab)"
                                        :class="activeTab === 'past' 
                                            ? 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 font-medium' 
                                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                                        class="px-4 py-2 text-sm transition-colors duration-150"
                                    >
                                        過去の調査一覧
                                    </button>
                                </div>
                            </div>
                            
                            <!-- 調査一覧テーブル -->
                            <div :class="activeTab === 'current' ? '' : 'hidden'">
                            <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">調査履歴</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">否理由</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">金額</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">期日</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">依頼人</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">担当者</th>
                                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">操作</th>
                                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">操作②</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($tableRows as $row)
                                        @php
                                            $investigation = $row['investigation_obj'];
                                        @endphp
                                        <tr data-investigation-type="{{ $row['investigation_type'] ?? '' }}">
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['investigation'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['rejection_reason'] ?: '-' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['amount'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['due_date'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['client'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $row['person_in_charge'] }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="{{ route('companies.investigations.edit', [$company, $investigation]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-md hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    編集
                                                </a>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                                <form method="POST" action="{{ route('companies.investigations.destroy', [$company, $investigation]) }}" class="inline" onsubmit="return confirm('本当に削除しますか？');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-md hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors duration-150">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        削除
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                            
                            <!-- 過去の調査一覧 -->
                            <div :class="activeTab === 'past' ? '' : 'hidden'">
                                <!-- ファイルアップロードフォーム -->
                                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">調査表をアップロード</h4>
                                    <form action="{{ route('companies.investigation-documents.upload', $company) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                        @csrf
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <div class="flex-1">
                                                <input 
                                                    type="file" 
                                                    name="document" 
                                                    id="document"
                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                    required
                                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                                        file:mr-4 file:py-2 file:px-4
                                                        file:rounded-md file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-blue-50 file:text-blue-700
                                                        hover:file:bg-blue-100
                                                        dark:file:bg-blue-900/30 dark:file:text-blue-300
                                                        dark:hover:file:bg-blue-900/50
                                                        cursor-pointer"
                                                >
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PDF、JPG、PNG形式（最大10MB）</p>
                                            </div>
                                            <div class="flex-1">
                                                <input 
                                                    type="text" 
                                                    name="description" 
                                                    id="description"
                                                    placeholder="説明（任意）"
                                                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 sm:text-sm"
                                                >
                                            </div>
                                            <div>
                                                <button 
                                                    type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150"
                                                >
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                    </svg>
                                                    アップロード
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- アップロード済みファイル一覧 -->
                                @if($documents && $documents->count() > 0)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">アップロード済み調査表</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($documents as $document)
                                                @php
                                                    $isImage = Str::startsWith($document->file_type, 'image/');
                                                    $isPdf = $document->file_type === 'application/pdf';
                                                    $previewUrl = route('companies.investigation-documents.preview', [$company, $document]);
                                                @endphp
                                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                                                    <!-- プレビュー表示エリア -->
                                                    @if($isImage)
                                                        <button
                                                            type="button"
                                                            x-data
                                                            x-on:click="window.openDocumentPreview('{{ $previewUrl }}', 'image', '{{ $document->file_name }}')"
                                                            class="block w-full mb-3 cursor-pointer group"
                                                        >
                                                            <div class="relative bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                                                                <img 
                                                                    src="{{ $previewUrl }}" 
                                                                    alt="{{ $document->file_name }}"
                                                                    class="w-full h-32 object-contain"
                                                                >
                                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center">
                                                                    <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-sm font-medium">
                                                                        クリックで拡大
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    @elseif($isPdf)
                                                        <button
                                                            type="button"
                                                            x-data
                                                            x-on:click="window.openDocumentPreview('{{ $previewUrl }}', 'pdf', '{{ $document->file_name }}')"
                                                            class="block w-full mb-3 cursor-pointer group"
                                                        >
                                                            <div class="relative bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden h-32 flex items-center justify-center">
                                                                <div class="text-center">
                                                                    <svg class="w-12 h-12 mx-auto text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                                                        <path d="M8 12h8v2H8zm0 4h8v2H8z"/>
                                                                    </svg>
                                                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">PDF</span>
                                                                </div>
                                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center">
                                                                    <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-sm font-medium">
                                                                        クリックでプレビュー
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    @endif

                                                    <div class="flex items-start justify-between mb-2">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate" title="{{ $document->file_name }}">
                                                                {{ $document->file_name }}
                                                            </p>
                                                            @if($document->description)
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $document->description }}</p>
                                                            @endif
                                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                                {{ $document->created_at->format('Y年m月d日 H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-2 mt-3">
                                                        <a 
                                                            href="{{ route('companies.investigation-documents.download', [$company, $document]) }}"
                                                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-150 text-xs"
                                                        >
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                            </svg>
                                                            ダウンロード
                                                        </a>
                                                        <form 
                                                            action="{{ route('companies.investigation-documents.delete', [$company, $document]) }}" 
                                                            method="POST" 
                                                            class="inline"
                                                            onsubmit="return confirm('本当に削除しますか？');"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button 
                                                                type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-md hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors duration-150 text-xs"
                                                            >
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                                削除
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                        <p>アップロードされた調査表はありません</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- 情報が登録されていない場合 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">情報が登録されていません</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">情報登録から情報を登録してください</p>
                        <div class="mt-6">
                            <a href="{{ route('companies.add-info', $company) }}">
                                <x-primary-button>
                                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    {{ __('情報登録') }}
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- 会社詳細モーダル -->
    <x-modal name="company-detail-modal" maxWidth="2xl">
        <div class="flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('企業情報詳細') }}
                </h2>
                <button
                    type="button"
                    x-on:click="$dispatch('close-modal', 'company-detail-modal')"
                    class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <div class="space-y-4">
                    @include('companies.partials.company-detail')
                </div>
            </div>
        </div>
    </x-modal>

    <!-- ドキュメントプレビューモーダル -->
    <div
        x-data="{ 
            open: false, 
            src: '', 
            type: '', 
            fileName: '',
            close() {
                this.open = false;
                this.src = '';
                this.type = '';
                this.fileName = '';
            }
        }"
        x-on:open-document-preview.window="
            open = true;
            src = $event.detail.src;
            type = $event.detail.type;
            fileName = $event.detail.fileName;
        "
        x-show="open"
        x-cloak
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
        style="display: none;"
    >
        <!-- オーバーレイ -->
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transform transition-all"
            x-on:click="close()"
        >
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <!-- モーダルコンテンツ -->
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-5xl sm:mx-auto"
        >
            <div class="flex flex-col max-h-[90vh]">
                <!-- ヘッダー -->
                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate" x-text="fileName">
                    </h2>
                    <div class="flex items-center gap-2">
                        <a 
                            :href="src" 
                            target="_blank"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors duration-150 text-sm"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            別タブで開く
                        </a>
                        <button
                            type="button"
                            x-on:click="close()"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- コンテンツ -->
                <div class="flex-1 overflow-auto p-4 bg-gray-100 dark:bg-gray-700">
                    <!-- 画像プレビュー -->
                    <template x-if="type === 'image'">
                        <div class="flex items-center justify-center min-h-[60vh]">
                            <img :src="src" :alt="fileName" class="max-w-full max-h-[75vh] object-contain rounded shadow-lg" />
                        </div>
                    </template>
                    <!-- PDFプレビュー -->
                    <template x-if="type === 'pdf'">
                        <iframe :src="src" class="w-full h-[75vh] rounded shadow-lg" frameborder="0"></iframe>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        // グローバル関数としてドキュメントプレビューを開く
        window.openDocumentPreview = function(src, type, fileName) {
            window.dispatchEvent(new CustomEvent('open-document-preview', {
                detail: { src, type, fileName }
            }));
        };
    </script>
</x-app-layout>

