<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'company_no',
        'region',
        'form_date',
        'company_name',
        'representative',
        'address',
        'tel',
        'has_related_company',
        'related_company_name',
        'related_company_address',
        'shareholding_ratio',
        'has_merger_dissolution',
        'decision',
        'teikoku_investigations',
        'tosho_investigations',
        'seni_investigations',
        'kensetsu_investigations',
        'rejection_reasons',
    ];

    protected $casts = [
        'has_related_company' => 'boolean',
        'has_merger_dissolution' => 'boolean',
        'form_date' => 'date',
        'due_date' => 'date',
        'teikoku_investigations' => 'array',
        'tosho_investigations' => 'array',
        'seni_investigations' => 'array',
        'kensetsu_investigations' => 'array',
        'rejection_reasons' => 'array',
    ];

    /**
     * 情報登録とのリレーション
     */
    public function investigations(): HasMany
    {
        return $this->hasMany(CompanyInvestigation::class);
    }

    /**
     * 調査表ファイルとのリレーション
     */
    public function investigationDocuments(): HasMany
    {
        return $this->hasMany(InvestigationDocument::class);
    }
}
