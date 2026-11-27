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
       Schema::create('subject_materials', function (Blueprint $table) {
        $table->id();
        $table->string('subject_code')->index();
        $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        // 'lesson' (Course Content/Notes) or 'paper' (Past/Model Papers)
        $table->enum('category', ['lesson', 'paper'])->default('lesson');
        // 'file' (PDF/DOCX/PPTX), 'youtube', or 'gdrive'
        $table->enum('type', ['file', 'youtube', 'gdrive']);
        $table->string('file_path')->nullable(); // Uploaded file path
        $table->string('file_extension')->nullable(); // pdf, docx, pptx
        $table->text('external_url')->nullable(); // YouTube / Google Drive link
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_materials');
    }
};
