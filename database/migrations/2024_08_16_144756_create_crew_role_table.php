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
        Schema::create('crew_role', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Crew::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Role::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_role');
    }
};