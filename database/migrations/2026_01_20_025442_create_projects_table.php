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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();
            $table->foreignId('period_id')
                ->constrained('periods')
                ->cascadeOnDelete();
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();
            $table->unsignedInteger('project_number')
                ->comment('Nomor project, reset per periode (diatur di backend)');

            $table->enum('type', [
                'time_charter',
                'freight_charter',
                'shipping_agency',
            ])->comment('Jenis project / kontrak');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->decimal('contract_value', 12, 2)
                ->default(0)
                ->comment('Nilai kontrak / nilai jual project');
            $table->enum('status', [
                'draft',
                'active',
                'finished',
                'cancelled',
            ])->default('draft')
                ->comment('Status project operasional');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
