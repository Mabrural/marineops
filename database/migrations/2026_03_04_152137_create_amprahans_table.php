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
        Schema::create('amprahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->onDelete('cascade');

            $table->foreignId('vessel_id')
                  ->constrained('vessels')
                  ->onDelete('cascade');

            $table->date('supply_date');

            $table->string('item');
            $table->string('specification')->nullable();

            $table->integer('qty');
            $table->string('unit');

            $table->string('vendor_name')->nullable();

            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amprahans');
    }
};
