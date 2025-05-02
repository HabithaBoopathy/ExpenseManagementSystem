<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userId = 1;

        $categories = ['Food', 'Travel', 'Utilities', 'Rent', 'Entertainment'];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName ]);}
    }
}
