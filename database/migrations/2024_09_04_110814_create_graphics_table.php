<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Content;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('graphics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class);
            $table->string('path');
            $table->String('type');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('graphics');
    }
};