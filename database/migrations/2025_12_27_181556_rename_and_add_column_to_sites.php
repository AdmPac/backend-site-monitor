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
        Schema::table('sites', function (Blueprint $table) {
            $table->renameColumn('url', 'full_url'); // https://www.google1.google2.com
            $table->string('base_url')->nullable(); // google1.google2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->renameColumn('full_url', 'url');
            $table->dropColumn('base_url');
        });
    }
};
