<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'title' => 'FAQ',
            'first_description' =>'Frequently asked',
            'second_description' => 'questions',
            'tertiary_description' => 'Browse through these FAQs to find answers to commonly asked questions',
            'image' => 'assets/uploads/images/faqs/1.png',
            'user_id'=>'1'
        ]); 
    }
}
