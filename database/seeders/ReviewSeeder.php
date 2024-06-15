<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'title' => 'Real Customers Reviews',
            'first_description_review' => 'What people say',
            'second_description_review' => 'See what our customers have to',
            'tertiary_description_review' => 'say about their experience',
            'user_id'=>'1',
        ]);
    }
}
