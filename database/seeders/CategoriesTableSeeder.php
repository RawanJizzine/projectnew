<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Travel', 'icon' => 'fa-globe', 'background_color' => '#87CEEB'],
            ['name' => 'Smart Phone', 'icon' => 'fa-mobile-alt', 'background_color' => '#ff9900'],
            ['name' => 'Shoes', 'icon' => 'fa-shoe-prints', 'background_color' => '#993333'],
            ['name' => 'Jewellery', 'icon' => 'fa-gem', 'background_color' => '#996633'],
            ['name' => 'Home Decor', 'icon' => 'fa-home', 'background_color' => '#669900'],
            ['name' => 'Grocery', 'icon' => 'fa-shopping-basket', 'background_color' => '#cc0000'],
        ];

        Category::insert($categories);
    }
}