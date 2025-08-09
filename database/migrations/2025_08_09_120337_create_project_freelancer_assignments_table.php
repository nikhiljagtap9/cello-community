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
        Schema::create('project_freelancer_assignments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('plot_id')->nullable(); // if plot optional
            $table->string('role', 50)->nullable(); // e.g., 'A' or 'B'

            $table->timestamps();

            // Foreign keys (optional, but recommended)
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plot_id')->references('id')->on('plots')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_freelancer_assignments');
    }
};
