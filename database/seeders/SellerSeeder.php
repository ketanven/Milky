<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            DB::table('sellers')->updateOrInsert(
                ['email' => "seller{$i}@milkly.com"], // prevent duplicates
                [
                    'name' => "Seller {$i}",
                    'email' => "seller{$i}@milkly.com",
                    'password' => Hash::make('Seller@123'),
                    'store_name' => "Dairy Shop {$i}",
                    'shop_address' => "Address Line {$i}, Mumbai, India",
                    'gst_number' => 'GSTIN' . rand(100000, 999999),
                    'pan_number' => 'PAN' . rand(1000, 9999),
                    'phone' => '98' . rand(10000000, 99999999),
                    'contact_email' => "seller{$i}@milkly.com",
                    'contact_phone' => '98' . rand(10000000, 99999999),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('✅ 30 Sellers seeded successfully (duplicates skipped).');
    }
}
