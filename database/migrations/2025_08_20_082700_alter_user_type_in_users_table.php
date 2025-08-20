<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Change ENUM to include sub_freelancer
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type 
            ENUM('admin','user','freelancer','prospect','sub_freelancer','sub_prospect') NOT NULL");
    }

    public function down(): void
    {
        // Rollback without sub_freelancer
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type 
            ENUM('admin','user','freelancer','prospect','sub_prospect') NOT NULL");
    }
};

