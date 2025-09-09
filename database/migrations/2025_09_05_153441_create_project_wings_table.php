<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectWingsTable extends Migration
{
    public function up()
    {
        Schema::create('project_wings', function (Blueprint $table) {
            $table->id();
            $table->string('plot_label');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // add FK in plots
        Schema::table('plots', function (Blueprint $table) {
            $table->foreignId('project_wing_id')->nullable()->after('project_id')->constrained('project_wings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_wings');

        Schema::table('plots', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_wing_id');
        });
    }
}

