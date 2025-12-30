<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First change the enum to include all possible values temporarily
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('enrolled', 'pending', 'withdrawn', 'approved', 'rejected') NOT NULL DEFAULT 'pending'");

        // Update existing data to match new enum values
        DB::table('enrollments')->where('status', 'approved')->update(['status' => 'enrolled']);
        DB::table('enrollments')->where('status', 'rejected')->update(['status' => 'withdrawn']);

        // Now change to final enum
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('enrolled', 'pending', 'withdrawn') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};
