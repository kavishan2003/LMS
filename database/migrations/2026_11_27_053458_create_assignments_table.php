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
        Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->string('subject_code')->index();
        $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
        $table->string('title');
        $table->text('instructions')->nullable(); // Assignment introduction & guidelines
        $table->string('attachment_path')->nullable(); // Optional question sheet PDF/Word
        $table->dateTime('deadline'); // Submission deadline
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
