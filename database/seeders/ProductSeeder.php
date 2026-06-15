<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            'brand_name' => Str::random(10),
            'product_name' => Str::random(10),
            'category' => Str::random(10),
        ]);
    }
}
