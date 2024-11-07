<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Display;

return new class extends Migration
{
    /**
     * Run the migrations.
    */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Display::class);
            $table->string('name');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->time('start_time_at');
            $table->time('end_time_at');
            $table->string('item_expire_time');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};