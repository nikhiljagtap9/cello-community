<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
     public function up(): void
    {
        Schema::table('plots', function (Blueprint $table) {
            // Rename column
            $table->renameColumn('project_name', 'plot_dimensions');

            // Add project_id after plot_dimensions
            $table->foreignId('project_id')
                ->after('plot_dimensions')
                ->constrained()
                ->onDelete('cascade'); // optional: deletes plots if project is deleted
        });
    }

    public function down(): void
    {
        Schema::table('plots', function (Blueprint $table) {
            // Revert changes
            $table->dropForeign(['project_id']);
            $table->dropColumn('project_id');
            $table->renameColumn('plot_dimensions', 'project_name');
        });
    }
};
