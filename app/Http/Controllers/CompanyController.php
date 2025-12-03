<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyInvestigation;
use App\Models\InvestigationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Company::query();
        
        // 会社名で検索
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('company_name', 'like', '%' . $search . '%');
        }
        
        $companies = $query->orderBy('id', 'asc')->paginate(20)->withQueryString();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBasicRequest($request);
        
        // Boolean値の変換
        $validated['has_related_company'] = $request->input('has_related_company') === '1';
        $validated['has_merger_dissolution'] = $request->input('has_merger_dissolution') === '1';

        Company::create($validated);

        return redirect()->route('companies.index')
            ->with('success', '企業情報が正常に登録されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        
        // Boolean値の変換
        $validated['has_related_company'] = $request->input('has_related_company') === '1';
        $validated['has_merger_dissolution'] = $request->input('has_merger_dissolution') === '1';
        
        // JSON形式のデータを処理
        $validated['teikoku_investigations'] = $this->processInvestigations($request, 'teikoku');
        $validated['tosho_investigations'] = $this->processInvestigations($request, 'tosho');
        $validated['seni_investigations'] = $this->processSimpleInvestigations($request, 'seni');
        $validated['kensetsu_investigations'] = $this->processSimpleInvestigations($request, 'kensetsu');
        $validated['rejection_reasons'] = $request->input('rejection_reasons', []);

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', '企業情報が正常に更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', '企業情報が正常に削除されました。');
    }

    /**
     * Display investigations list for the company.
     */
    public function investigations(Company $company): View
    {
        $investigations = $company->investigations()->latest()->get();
        $documents = $company->investigationDocuments()->latest()->get();
        return view('companies.investigations', compact('company', 'investigations', 'documents'));
    }

    /**
     * Show the form for adding additional information to the company.
     */
    public function addInfo(Company $company): View
    {
        return view('companies.add-info', compact('company'));
    }

    /**
     * Store additional information for the company.
     */
    public function storeInfo(Request $request, Company $company): RedirectResponse
    {
        $validated = $this->validateInfoRequest($request);
        
        // JSON形式のデータを処理
        $validated['teikoku_investigations'] = $this->processInvestigations($request, 'teikoku');
        $validated['tosho_investigations'] = $this->processInvestigations($request, 'tosho');
        $validated['seni_investigations'] = $this->processSimpleInvestigations($request, 'seni');
        $validated['kensetsu_investigations'] = $this->processSimpleInvestigations($request, 'kensetsu');
        $validated['rejection_reasons'] = $request->input('rejection_reasons', []);
        $validated['company_id'] = $company->id;

        // 新しいテーブルに保存
        \App\Models\CompanyInvestigation::create($validated);

        return redirect()->route('companies.investigations', $company)
            ->with('success', '追加情報が正常に登録されました。');
    }

    /**
     * Show the form for editing the investigation.
     */
    public function editInvestigation(Company $company, CompanyInvestigation $investigation): View
    {
        return view('companies.edit-investigation', compact('company', 'investigation'));
    }

    /**
     * Update the investigation.
     */
    public function updateInvestigation(Request $request, Company $company, CompanyInvestigation $investigation): RedirectResponse
    {
        $validated = $this->validateInfoRequest($request);
        
        // JSON形式のデータを処理
        $validated['teikoku_investigations'] = $this->processInvestigations($request, 'teikoku');
        $validated['tosho_investigations'] = $this->processInvestigations($request, 'tosho');
        $validated['seni_investigations'] = $this->processSimpleInvestigations($request, 'seni');
        $validated['kensetsu_investigations'] = $this->processSimpleInvestigations($request, 'kensetsu');
        $validated['rejection_reasons'] = $request->input('rejection_reasons', []);

        $investigation->update($validated);

        return redirect()->route('companies.investigations', $company)
            ->with('success', '調査情報が正常に更新されました。');
    }

    /**
     * Remove the investigation.
     */
    public function destroyInvestigation(Company $company, CompanyInvestigation $investigation): RedirectResponse
    {
        $investigation->delete();

        return redirect()->route('companies.investigations', $company)
            ->with('success', '調査情報が正常に削除されました。');
    }

    /**
     * 基本情報のバリデーション（第1段階）
     */
    private function validateBasicRequest(Request $request): array
    {
        return $request->validate([
            'company_no' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'form_date' => 'nullable|date',
            'company_name' => 'nullable|string|max:255',
            'representative' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'tel' => 'nullable|string|max:255',
            'has_related_company' => 'nullable|string|in:0,1',
            'related_company_name' => 'nullable|string|max:255',
            'related_company_address' => 'nullable|string',
            'shareholding_ratio' => 'nullable|string|max:255',
            'has_merger_dissolution' => 'nullable|string|in:0,1',
            'decision' => 'nullable|string|in:採,否,裏書',
        ]);
    }

    /**
     * 追加情報のバリデーション（第2段階）
     */
    private function validateInfoRequest(Request $request): array
    {
        return $request->validate([
            'rejection_comment' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'due_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'first_endorsement' => 'nullable|string|max:255',
            'second_endorsement' => 'nullable|string|max:255',
            'client_type' => 'nullable|string|in:A,旧A,B,その他',
            'client_other' => 'nullable|string|max:255',
            'client_company_name' => 'nullable|string|max:255',
            'client_address' => 'nullable|string',
            'client_representative' => 'nullable|string|max:255',
            'client_tel' => 'nullable|string|max:255',
            'person_in_charge_opinion' => 'nullable|string',
            'person_in_charge' => 'nullable|string|max:255',
            'sales_representative' => 'nullable|string|max:255',
        ]);
    }

    /**
     * リクエストのバリデーション（全項目）
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'company_no' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'form_date' => 'nullable|date',
            'company_name' => 'nullable|string|max:255',
            'representative' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'tel' => 'nullable|string|max:255',
            'has_related_company' => 'nullable|string|in:0,1',
            'related_company_name' => 'nullable|string|max:255',
            'related_company_address' => 'nullable|string',
            'shareholding_ratio' => 'nullable|string|max:255',
            'has_merger_dissolution' => 'nullable|string|in:0,1',
            'decision' => 'nullable|string|in:採,否,裏書',
            'rejection_comment' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'due_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'first_endorsement' => 'nullable|string|max:255',
            'second_endorsement' => 'nullable|string|max:255',
            'client_type' => 'nullable|string|in:A,旧A,B,その他',
            'client_other' => 'nullable|string|max:255',
            'client_company_name' => 'nullable|string|max:255',
            'client_address' => 'nullable|string',
            'client_representative' => 'nullable|string|max:255',
            'client_tel' => 'nullable|string|max:255',
            'person_in_charge_opinion' => 'nullable|string',
            'person_in_charge' => 'nullable|string|max:255',
            'sales_representative' => 'nullable|string|max:255',
        ]);
    }

    /**
     * 調査履歴データを処理
     */
    private function processInvestigations(Request $request, string $type): ?array
    {
        $investigations = [];
        $count = 4; // 各調査機関につき4つの調査履歴
        
        for ($i = 0; $i < $count; $i++) {
            $investigationDateYear = $request->input("{$type}_investigation_date_year_{$i}");
            $investigationDatePoint = $request->input("{$type}_investigation_date_point_{$i}");
            $settlementYear = $request->input("{$type}_settlement_year_{$i}");
            $settlementMonth = $request->input("{$type}_settlement_month_{$i}");
            $financialStatementPublic = $request->has("{$type}_financial_statement_public_{$i}");
            $hasRealEstate = $request->has("{$type}_has_real_estate_{$i}");
            $historyYears = array_filter([
                $request->input("{$type}_history_year_0_{$i}"),
                $request->input("{$type}_history_year_1_{$i}"),
                $request->input("{$type}_history_year_2_{$i}"),
                $request->input("{$type}_history_year_3_{$i}"),
            ]);
            
            // 少なくとも1つの主要フィールドが入力されている場合のみ追加
            $hasData = !empty($investigationDateYear) || !empty($investigationDatePoint) ||
                       !empty($settlementYear) || !empty($settlementMonth) ||
                       $financialStatementPublic || $hasRealEstate ||
                       !empty($historyYears);
            
            if ($hasData) {
                $investigations[] = [
                    'investigation_date_year' => $investigationDateYear,
                    'investigation_date_point' => $investigationDatePoint,
                    'settlement_year' => $settlementYear,
                    'settlement_month' => $settlementMonth,
                    'financial_statement_public' => $financialStatementPublic,
                    'has_real_estate' => $hasRealEstate,
                    'history_years' => array_values($historyYears), // インデックスを再振り当て
                ];
            }
        }
        
        return !empty($investigations) ? $investigations : null;
    }

    /**
     * シンプルな調査履歴データを処理（繊維・建設用）
     */
    private function processSimpleInvestigations(Request $request, string $type): ?array
    {
        $investigations = [];
        $count = 3; // 各調査機関につき3つの調査履歴
        
        for ($i = 0; $i < $count; $i++) {
            $year = $request->input("{$type}_year_{$i}");
            $has = $request->has("{$type}_has_{$i}");
            
            // 年が入力されているか、有無がチェックされている場合のみ追加
            if (!empty(trim($year ?? '')) || $has) {
                $investigations[] = [
                    'year' => $year ?: null,
                    'has' => $has,
                ];
            }
        }
        
        return !empty($investigations) ? $investigations : null;
    }

    /**
     * Upload investigation document.
     */
    public function uploadDocument(Request $request, Company $company): RedirectResponse
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            'description' => 'nullable|string|max:500',
        ]);

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('investigation_documents/' . $company->id, $fileName, 'public');

        InvestigationDocument::create([
            'company_id' => $company->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('companies.investigations', $company)
            ->with('success', '調査表が正常にアップロードされました。');
    }

    /**
     * Download investigation document.
     */
    public function downloadDocument(Company $company, InvestigationDocument $document)
    {
        if ($document->company_id !== $company->id) {
            abort(403);
        }

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    /**
     * Delete investigation document.
     */
    public function deleteDocument(Company $company, InvestigationDocument $document): RedirectResponse
    {
        if ($document->company_id !== $company->id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('companies.investigations', $company)
            ->with('success', '調査表が正常に削除されました。');
    }
}
