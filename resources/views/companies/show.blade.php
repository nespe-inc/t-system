<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('企業情報詳細') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('companies.edit', $company) }}">
                    <x-primary-button type="button">
                        {{ __('編集') }}
                    </x-primary-button>
                </a>
                <a href="{{ route('companies.index') }}">
                    <x-secondary-button type="button">
                        {{ __('一覧に戻る') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('companies.partials.company-detail')
        </div>
    </div>
</x-app-layout>

