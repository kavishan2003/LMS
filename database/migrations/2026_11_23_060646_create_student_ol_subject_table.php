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
        Schema::create('student_ol_subject', function (Blueprint $table) {
            $table->id();
            // Student ID (users table link)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Subject ID (OLsubjects table link)
            $table->foreignId('olsubject_id')->constrained('olsubjects')->onDelete('cascade');

            $table->timestamps();

            // adding two foreign keys as a unique constraint to prevent duplicate entries for the same student and subject
            $table->unique(['user_id', 'olsubject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_ol_subject');
    }
};
