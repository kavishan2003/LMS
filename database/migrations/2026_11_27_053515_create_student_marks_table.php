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
      Schema::create('student_marks', function (Blueprint $table) {
        $table->id();
        $table->string('subject_code')->index();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Student
        $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
        $table->string('exam_title')->default('Term Test'); // Ex: Term 1, Assignment 1, Final
        $table->decimal('marks', 5, 2); // 0.00 - 100.00
        $table->string('remarks')->nullable();
        $table->timestamps();

        $table->unique(['subject_code', 'user_id', 'exam_title']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
