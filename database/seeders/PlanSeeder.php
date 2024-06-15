<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'user_id'=>'1',
            'title' => 'Pricing Plans',
            'first_description' => 'Tailored pricing plans',
            'second_description' => 'designed for you',
            'tertiary_description' => 'All plans include 40+ advanced tools and features to boost your product',
            'four_description' => 'Choose the best plan to fit',
            'text_switch_left' => 'Pay Monthly',
            'text_switch_right' => 'Pay Annual',
        ]); 
    }
}
