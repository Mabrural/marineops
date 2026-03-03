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
        Schema::create('asset_maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->date('maintenance_date')->nullable();
            $table->enum('type', [
                'routine',
                'repair',
                'inspection',
            ]);
            $table->text('description')->nullable();
            $table->string('performed_by')->nullable(); // siapa yang melakukan perbaikan, misal pak welly or vendor PT xyz
            $table->decimal('cost', 12, 2)->default(0); // biaya maintenance or insepction or repair
            $table->string('result_status')->nullable(); // hasil perbaikan
            $table->date('estimate_next_maintenance')->nullable(); // estimate perbaikan selanjutnya
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_maintenance_logs');
    }
};
