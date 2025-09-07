<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plots', function (Blueprint $table) {
            $table->string('plot_size')->nullable()->change();
            $table->string('plot_location')->nullable()->change();
            $table->string('plot_dimensions')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('plots', function (Blueprint $table) {
            $table->string('plot_size')->nullable(false)->change();
            $table->string('plot_location')->nullable(false)->change();
            $table->string('plot_dimensions')->nullable(false)->change();
        });
    }
};

