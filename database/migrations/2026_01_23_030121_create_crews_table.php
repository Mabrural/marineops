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
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();
            $table->foreignId('vessel_id')
                ->constrained('vessels')
                ->cascadeOnDelete();
            $table->string('name', 100);
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->default('Indonesia');
            $table->string('seafarer_code')->nullable();
            $table->string('seafarer_book_number')->nullable();
            $table->date('seafarer_book_expired_at')->nullable();
            $table->string('position')->nullable();
            $table->string('certificate')->nullable();
            $table->string('certificate_number')->nullable();
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('crews');
    }
};
