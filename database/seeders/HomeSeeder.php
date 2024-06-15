<?php

namespace Database\Seeders;

use App\Models\HomeData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeData::create([
            'title' => 'One dashboard to manage all your businesses',
            'main_description' => 'Production-ready & easy to use Admin Template',
            'secondary_description' => 'for Reliability and Customizability',
            'button_text' => 'Get early access',
            'image_link_dashboard' => 'assets/uploads/images/home/dashboard.png',
            'image_link_element' => 'assets/uploads/images/home/element.png',
            'user_id'=>'1',

        ]);
    }
}
