<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Change grade from string to JSON
            $table->json('grades')->nullable()->after('subject');
        });

        // Migrate existing data: convert single grade to JSON array
        $teachers = \App\Models\Teacher::all();
        foreach ($teachers as $teacher) {
            if ($teacher->grade) {
                $teacher->grades = [$teacher->grade];
                $teacher->save();
            }
        }

        // Drop the old grade column
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('grade');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('grade')->nullable()->after('subject');
        });

        // Migrate back: convert JSON to single grade
        $teachers = \App\Models\Teacher::all();
        foreach ($teachers as $teacher) {
            if ($teacher->grades && is_array($teacher->grades) && count($teacher->grades) > 0) {
                $teacher->grade = $teacher->grades[0];
                $teacher->save();
            }
        }

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('grades');
        });
    }
};