<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestigationDocument extends Model
{
    protected $fillable = [
        'company_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
    ];

    /**
     * 企業とのリレーション
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
