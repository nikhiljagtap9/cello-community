<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToProjectWingsTable extends Migration
{
    public function up()
    {
        Schema::table('project_wings', function (Blueprint $table) {
            $table->string('image')->nullable()->after('project_id');
        });
    }

    public function down()
    {
        Schema::table('project_wings', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}

