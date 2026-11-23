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
        Schema::table('student_ol_subject', function (Blueprint $table) {
            $table->string('grade')->after('olsubject_id');
            $table->string('medium')->after('grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_ol_subject', function (Blueprint $table) {
            $table->dropColumn(['grade', 'medium']);
        });
    }
};
