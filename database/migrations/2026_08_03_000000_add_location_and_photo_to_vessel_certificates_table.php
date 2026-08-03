<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vessel_certificates', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->after('name');
            $table->string('foto')->nullable()->after('certificate_file');
        });
    }

    public function down(): void
    {
        Schema::table('vessel_certificates', function (Blueprint $table) {
            $table->dropColumn(['lokasi', 'foto']);
        });
    }
};
