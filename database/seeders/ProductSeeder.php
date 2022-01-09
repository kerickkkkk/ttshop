<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => '滷肉飯',
            'price' => 20,
        ]);

        Product::create([
            'name' => '陽春麵',
            'price' => 50,
        ]);
    }
}
