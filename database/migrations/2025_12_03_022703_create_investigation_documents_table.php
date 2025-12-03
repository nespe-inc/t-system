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
        Schema::create('investigation_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->comment('企業ID');
            $table->string('file_name')->comment('ファイル名');
            $table->string('file_path')->comment('ファイルパス');
            $table->string('file_type')->nullable()->comment('ファイルタイプ（MIME）');
            $table->unsignedBigInteger('file_size')->nullable()->comment('ファイルサイズ（バイト）');
            $table->text('description')->nullable()->comment('説明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigation_documents');
    }
};
