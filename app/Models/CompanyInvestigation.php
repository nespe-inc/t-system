<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInvestigation extends Model
{
    protected $fillable = [
        'company_id',
        'teikoku_investigations',
        'tosho_investigations',
        'seni_investigations',
        'kensetsu_investigations',
        'rejection_reasons',
        'rejection_comment',
        'amount',
        'due_date',
        'bill_no',
        'bank_branch',
        'first_endorsement',
        'second_endorsement',
        'client_type',
        'client_other',
        'client_company_name',
        'client_address',
        'client_representative',
        'client_tel',
        'person_in_charge_opinion',
        'person_in_charge',
        'sales_representative',
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'teikoku_investigations' => 'array',
        'tosho_investigations' => 'array',
        'seni_investigations' => 'array',
        'kensetsu_investigations' => 'array',
        'rejection_reasons' => 'array',
    ];

    /**
     * 企業とのリレーション
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
