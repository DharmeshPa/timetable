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
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropColumn(['start_at', 'end_at']);
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->integer('start_at')->nullable();
            $table->string('end_at')->nullable();
        });
    }
};
