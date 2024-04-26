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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->string('program_name');
            $table->text('image')->nullable();
            $table->text('guidelines')->nullable();
            $table->date('time_start')->nullable();
            $table->date('time_end')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('condition')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('assessment')->nullable();
            $table->longText('awards')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};
