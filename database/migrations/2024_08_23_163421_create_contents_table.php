<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


use App\Models\Timetable;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Timetable::class);
            $table->string('group_title')->nullable();
            $table->string('start_time_at');
            $table->string('end_time_at');
            $table->tinyInteger('visibility')->nullable()->default(1);
            $table->tinyInteger('group_title_bold')->nullable()->default(0);
            $table->tinyInteger('group_title_italic')->nullable()->default(0);
            $table->tinyInteger('hide_session_end_time')->nullable()->default(0);
            $table->enum('type', ['message', 'graphic','video','topics']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
