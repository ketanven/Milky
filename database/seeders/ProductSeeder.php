<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Example products
        $products = [
            ['name' => 'Full Cream Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 50],
            ['name' => 'Toned Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 45],
            ['name' => 'Buffalo Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 55],
            ['name' => 'Organic Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 70],
            ['name' => 'Curd', 'unit' => 'Kg', 'freshness' => '1-day-old', 'price' => 60],
            ['name' => 'Paneer', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 200],
            ['name' => 'Butter', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 300],
            ['name' => 'Ghee', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 450],
            ['name' => 'Cheese', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 400],
            ['name' => 'Flavored Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 60],
            ['name' => 'Lassi', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 50],
            ['name' => 'Buttermilk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 40],
            ['name' => 'Cream', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 250],
            ['name' => 'Khoa / Mawa', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 300],
            ['name' => 'Milk Powder', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 350],
            ['name' => 'Condensed Milk', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 200],
            ['name' => 'Ice Cream', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 350],
            ['name' => 'Shrikhand', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 220],
            ['name' => 'Probiotic Drinks', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 70],
            ['name' => 'Dairy Sweets', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 400],
            ['name' => 'Milkshake Mix', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 150],
            ['name' => 'Dahi Pouch', 'unit' => 'Kg', 'freshness' => '1-day-old', 'price' => 50],
            ['name' => 'UHT Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 65],
            ['name' => 'Chocolate Milk', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 70],
            ['name' => 'Whipping Cream', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 300],
            ['name' => 'Dairy Beverages', 'unit' => 'Litre', 'freshness' => 'Fresh', 'price' => 60],
            ['name' => 'Organic Paneer', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 250],
            ['name' => 'Buffalo Ghee', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 500],
            ['name' => 'Cow Ghee', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 450],
            ['name' => 'Flavored Yogurt', 'unit' => 'Kg', 'freshness' => 'Fresh', 'price' => 120],
        ];

        foreach ($products as $index => $product) {
            DB::table('products')->insert([
                'seller_id' => rand(1, 30), // random seller from 1-30
                'category_id' => rand(1, 30), // random category
                'name' => $product['name'],
                'sku' => 'SKU' . rand(1000, 9999),
                'description' => $product['name'] . ' - high quality Indian dairy product.',
                'price' => $product['price'],
                'quantity' => rand(10, 100),
                'unit' => $product['unit'],
                'freshness' => $product['freshness'],
                'image' => 'image' . ($index + 1) . '.jpg', // image1.jpg, image2.jpg ...
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
