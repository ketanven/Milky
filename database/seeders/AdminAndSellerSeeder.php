<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Seller;

class AdminAndSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ---------- SUPER ADMIN ----------
        Admin::firstOrCreate(
            ['email' => 'superadmin@milkly.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Super@123'),
                'designation' => 'Super Admin',
                'department' => 'Management',
                'is_active' => true,
            ]
        );

        // ---------- SUB ADMIN ----------
        Admin::firstOrCreate(
            ['email' => 'subadmin@milkly.com'],
            [
                'name' => 'Sub Admin',
                'password' => Hash::make('Sub@123'),
                'designation' => 'Sub Admin',
                'department' => 'Operations',
                'is_active' => true,
            ]
        );


        $this->command->info('✅ Admins and Sellers seeded successfully (duplicates skipped).');
    }
}
