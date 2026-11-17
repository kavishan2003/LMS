<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ALsubjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_code')->unique(); // උදා: AL01-SI
            $table->string('name');
            $table->enum('medium', ['Sinhala', 'Tamil', 'English']);
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_l_subjects');
    }
};
