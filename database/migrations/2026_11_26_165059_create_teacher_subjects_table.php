<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->unique()->constrained('teachers')->onDelete('cascade');
            $table->string('section'); // 'OL' or 'AL'
            
            //1 sub compulsery
            $table->unsignedBigInteger('subject_1_id');
            $table->unsignedBigInteger('subject_2_id')->nullable();
            $table->unsignedBigInteger('subject_3_id')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_subjects');
    }
};