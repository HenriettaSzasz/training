<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->updateOrInsert([
            'name' => 'item 4',
            'units' => '1',
            'price' => 1,
            'description' => 'A very cheap product added with seed',
            'category_id' => '1',
        ]);
        DB::table('products')->updateOrInsert([
            'name' => 'item 1',
            'units' => 2,
            'price' => 150,
            'description' => 'Best product on the market',
            'category_id' => '2',
        ]);
        DB::table('products')->updateOrInsert([
            'name' => 'item 2',
            'units' => 200,
            'price' => 5,
            'description' => 'Just a cheap product with large stock',
            'category_id' => '2',
        ]);
        DB::table('products')->updateOrInsert([
            'name' => 'item 3',
            'units' => 20,
            'price' => 45,
            'description' => 'An average, affordable product',
            'category_id' => '2',
        ]);
    }
}
