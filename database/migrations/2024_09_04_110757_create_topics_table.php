<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Content;
use App\Models\Location;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class);
            $table->foreignIdFor(Location::class);
            $table->string('title')->nullable();
            $table->tinyInteger('bold')->nullable();
            $table->tinyInteger('italic')->nullable();
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
