<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // <-- Needed for slug

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Milk', 'Curd', 'Paneer', 'Butter', 'Ghee', 'Cheese', 'Flavored Milk', 'Lassi', 
            'Buttermilk', 'Cream', 'Khoa / Mawa', 'Milk Powder', 'Condensed Milk', 'Ice Cream', 
            'Shrikhand', 'Probiotic Drinks', 'Organic Milk', 'Buffalo Milk', 'Cow Milk', 'Toned Milk', 
            'Full Cream Milk', 'Skimmed Milk', 'Dairy Sweets', 'Milkshake Mix', 'Dairy Beverages', 
            'Dahi Pouch', 'UHT Milk', 'Chocolate Milk', 'Whipping Cream', 'Dairy Snacks'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category), // <-- Added slug
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
