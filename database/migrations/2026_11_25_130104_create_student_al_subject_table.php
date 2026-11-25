<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_al_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('grade'); // 12 or 13
            $table->string('medium'); // Sinhala, Tamil, English
            $table->string('stream'); // Physical Science, Biological Science, Commerce, Arts, Technology
            
            // General English & Common General Test IDs JSON array save
            $table->json('compulsory_subjects'); 
            
            // Stream main 3 subjects
            $table->foreignId('subject_1_id')->constrained('alsubjects');
            $table->foreignId('subject_2_id')->constrained('alsubjects');
            $table->foreignId('subject_3_id')->constrained('alsubjects');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_al_subject');
    }
};