<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the admin user
        $admin = User::create([
            'email'      => 'admin@example.com',
            'password'   => Hash::make('admin123'),  // Use secure password in production
            'user_type'  => 'admin',
            'parent_id'  => null,
        ]);

        // Optional: Create related user details
        UserDetail::create([
            'user_id'    => $admin->id,
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'address'    => 'Admin Street, Head Office',
            'phone'      => '9999999999',
            'passport'   => null,
            'picture'    => null,
        ]);
    }
}

