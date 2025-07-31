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
        Schema::table('users', function (Blueprint $table) {
            // If you previously had 'name', and it's unused, you can drop it:
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }

            $table->enum('user_type', ['admin', 'user', 'freelance', 'prospect', 'sub-prospect'])->after('password');
            $table->unsignedBigInteger('parent_id')->nullable()->after('user_type');
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['user_type', 'parent_id']);
        });
    }
};
