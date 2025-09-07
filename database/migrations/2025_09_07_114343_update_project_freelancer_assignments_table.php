<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectFreelancerAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::table('project_freelancer_assignments', function (Blueprint $table) {
            // Rename column freelancer_id to user_id
            $table->renameColumn('freelancer_id', 'user_id');

            // Remove the 'role' and 'status' columns
            if (Schema::hasColumn('project_freelancer_assignments', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('project_freelancer_assignments', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    public function down()
    {
        Schema::table('project_freelancer_assignments', function (Blueprint $table) {
            // Rename user_id back to freelancer_id
            $table->renameColumn('user_id', 'freelancer_id');

            // Add the removed columns back
            $table->string('role')->nullable();
            $table->string('status')->nullable();
        });
    }
}
