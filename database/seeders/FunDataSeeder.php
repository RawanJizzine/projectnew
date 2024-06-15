<?php

namespace Database\Seeders;

use App\Models\FunFact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funFacts = [
            [
                
                'event' => '7.1k+',
                'title' => 'Support Tickets',
                'text' => 'Resolved',
                'image' => 'assets/uploads/images/funs/1.png',
                'border_color' => 'border-label-primary',
            ],
            [
                'event' => '50k+',
                'title' => 'Join Creatives',
                'text' => 'Community',
                'image' => 'assets/uploads/images/funs/2.png',
                'border_color' => 'border-label-success',
            ],
            [
                'event' => '60k+',
                'title' => 'Highly Rated',
                'text' => 'Products',
                'image' => 'assets/uploads/images/funs/3.png',
                'border_color' => 'border-label-info',
            ],
            [
                'event' => '100%',
                'title' => 'Money Back',
                'text' => 'Guarantee',
                'image' => 'assets/uploads/images/funs/4.png',
                'border_color' => 'border-label-warning',
            ],
        ];

        foreach ($funFacts as $fact) {
            FunFact::create([
                'user_id' => '1', // Assuming $user_id is defined elsewhere
                'event' => $fact['event'],
                'title' => $fact['title'],
                'text' => $fact['text'],
                'image' => $fact['image'],
                'border_color' => $fact['border_color'],
            ]);
        }
    }
}
