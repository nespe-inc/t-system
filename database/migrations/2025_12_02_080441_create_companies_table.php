<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            // 企業基本情報
            $table->string('company_no')->nullable()->comment('企業NO');
            $table->string('region')->nullable()->comment('東');
            $table->date('form_date')->nullable()->comment('日付');
            $table->string('company_name')->nullable()->comment('会社名');
            $table->string('representative')->nullable()->comment('代表者');
            $table->text('address')->nullable()->comment('住所');
            $table->string('tel')->nullable()->comment('TEL');
            
            // 関連・系列会社
            $table->boolean('has_related_company')->default(false)->comment('関連・系列会社有無');
            $table->string('related_company_name')->nullable()->comment('関連・系列会社名');
            $table->text('related_company_address')->nullable()->comment('関連・系列会社住所');
            $table->string('shareholding_ratio')->nullable()->comment('持分比率');
            
            // 合併・解散歴
            $table->boolean('has_merger_dissolution')->default(false)->comment('合併・解散歴有無');
            
            // 採否裏書
            $table->string('decision')->nullable()->comment('採否裏書: 採/否/裏書');
            
            // 調査履歴（JSON形式で保存）
            $table->json('teikoku_investigations')->nullable()->comment('帝国調査履歴');
            $table->json('tosho_investigations')->nullable()->comment('東商調査履歴');
            $table->json('seni_investigations')->nullable()->comment('繊維調査履歴');
            $table->json('kensetsu_investigations')->nullable()->comment('建設調査履歴');
            
            // 否理由
            $table->json('rejection_reasons')->nullable()->comment('否理由（チェック項目）');
            $table->text('rejection_comment')->nullable()->comment('否理由コメント');
            
            // 金額・期日・手形情報
            $table->decimal('amount', 15, 2)->nullable()->comment('金額');
            $table->date('due_date')->nullable()->comment('期日');
            $table->string('bill_no')->nullable()->comment('手形No');
            $table->string('bank_branch')->nullable()->comment('銀行支店');
            $table->string('first_endorsement')->nullable()->comment('1裏');
            $table->string('second_endorsement')->nullable()->comment('2裏');
            
            // 依頼人情報
            $table->string('client_type')->nullable()->comment('依頼人タイプ: A/旧A/B/その他');
            $table->string('client_other')->nullable()->comment('その他の場合の詳細');
            $table->string('client_company_name')->nullable()->comment('依頼人会社名');
            $table->text('client_address')->nullable()->comment('依頼人住所');
            $table->string('client_representative')->nullable()->comment('依頼人代表者');
            $table->string('client_tel')->nullable()->comment('依頼人TEL');
            
            // 担当者情報
            $table->text('person_in_charge_opinion')->nullable()->comment('担当者意見');
            $table->string('person_in_charge')->nullable()->comment('担当者');
            $table->string('sales_representative')->nullable()->comment('営業担当');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
