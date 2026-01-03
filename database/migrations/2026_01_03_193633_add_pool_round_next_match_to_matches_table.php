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
        Schema::table('matches', function (Blueprint $table) {
            $table->foreignId('pool_id')->nullable()->constrained('pools')->onDelete('cascade');
            $table->string('round')->default('poule'); // poule, semi, final
            $table->foreignId('next_match_id')->nullable()->constrained('matches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropForeign(['pool_id']);
            $table->dropColumn('pool_id');
            $table->dropColumn('round');
            $table->dropForeign(['next_match_id']);
            $table->dropColumn('next_match_id');
        });
    }
};
