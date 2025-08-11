<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Remove status from projects
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'status')) {
                $table->dropColumn('status');
            }
        });

        // Add status to project_freelancer_assignments
        Schema::table('project_freelancer_assignments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ongoing', 'completed'])
                  ->default('pending')
                  ->after('plot_id');
        });
    }

    public function down(): void
    {
        // Re-add status to projects
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ongoing', 'completed'])
                  ->default('pending')
                  ->after('user_id');
        });

        // Remove status from project_freelancer_assignments
        Schema::table('project_freelancer_assignments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

