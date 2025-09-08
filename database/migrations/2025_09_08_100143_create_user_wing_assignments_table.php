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
        Schema::create('user_wing_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The user assigned
            $table->unsignedBigInteger('project_wing_id'); // The wing
            $table->unsignedBigInteger('assigned_by')->nullable(); // Who assigned this user
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_wing_id')->references('id')->on('project_wings')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('set null');

            $table->unique(['user_id', 'project_wing_id']); // Avoid duplicate assignments
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wing_assignments');
    }
};
