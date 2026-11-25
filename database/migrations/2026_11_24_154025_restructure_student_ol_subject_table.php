<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // remove old table and re structure the student_ol_subject table with new columns and relationships
        Schema::dropIfExists('student_ol_subject');

        Schema::create('student_ol_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('grade'); // 6 - 11
            $table->string('medium'); // Sinhala, Tamil, English
            
            // save the main subjects as a JSON array in the main_subjects column
            $table->json('main_subjects'); 
            
            // Religion ID 
            $table->foreignId('religion_id')->constrained('olsubjects');
            
            // Basket subjects 3
            $table->foreignId('basket_1_id')->nullable()->constrained('olsubjects');
            $table->foreignId('basket_2_id')->nullable()->constrained('olsubjects');
            $table->foreignId('basket_3_id')->nullable()->constrained('olsubjects');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_ol_subject');
    }
};