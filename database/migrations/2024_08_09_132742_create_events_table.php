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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Venue::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Theme::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->date('start_at');
            $table->date('end_at');
            $table->longText('description')->nullable();
            $table->integer('offset')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};


