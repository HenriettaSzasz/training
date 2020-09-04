<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->updateOrInsert([
            'name' => 'category 1',
            'briefing' => 'a small category for just a few products',
        ]);

        DB::table('categories')->updateOrInsert([
            'name' => 'category 2',
            'briefing' => 'a larger category',
        ]);
    }
}
