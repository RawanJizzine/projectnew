<?php

namespace Database\Seeders;

use App\Models\ReviewsData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $reviewsData = [
            [
                'name' => 'Cecilia Payne',
                'description' => '“Vuexy is hands down the most useful front end Bootstrap theme I\'ve ever used. I can\'t wait to use it again for my next project.”',
                'image' => 'assets/uploads/images/reviews/1.png',
                'position' => 'CEO of Airbnb',
                'rating' => 5,
                'icon'=>'assets/uploads/images/reviews/7.png',
            ],
            [
                'name' => 'Eugenia Moore',
                'description' => '“I\'ve never used a theme as versatile and flexible as Vuexy. It\'s my go to for building dashboard sites on almost any project.”',
                'image' =>'assets/uploads/images/reviews/2.png',
                'position' => 'Founder of Hubspot',
                'rating' => 5,
                'icon'=>'assets/uploads/images/reviews/8.png',
            ],
            [
                'name' => 'Curtis Fletcher',
                'description' => 'This template is really clean & well documented. The docs are really easy to understand and it\'s always easy to find a screenshot from their website.',
                'image' => 'assets/uploads/images/reviews/3.png',
                'position' => 'Design Lead at Dribbble',
                'rating' => 5,
                'icon'=>'assets/uploads/images/reviews/9.png',
            ],
            [
                'name' => 'Sara Smith',
                'description' => 'All the requirements for developers have been taken into consideration, so I’m able to build any interface I want.',
                'image' => 'assets/uploads/images/reviews/4.png',
                'position' => 'Founder of Continental',
                'rating' => 4,
                'icon'=>'assets/uploads/images/reviews/10.png',
            ],
            [
                'name' => 'Eugenia Moore',
                'description' => '“I\'ve never used a theme as versatile and flexible as Vuexy. It\'s my go to for building dashboard sites on almost any project.”',
                'image' => 'assets/uploads/images/reviews/5.png',
                'position' => 'Founder of Hubspot',
                'rating' => 5,
                'icon'=>'assets/uploads/images/reviews/11.png',
            ],
            [
                'name' => 'Sara Smith',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam nemo mollitia, ad eum officia numquam nostrum repellendus consequuntur!',
                'image' => 'assets/uploads/images/reviews/6.png',
                'position' => 'Founder of Continental',
                'rating' => 4,
                'icon'=>'assets/uploads/images/reviews/12.png',
            ],
        ];

        foreach ($reviewsData as $data) {
            ReviewsData::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'image' =>  $data['image'],
                'position' => $data['position'],
                'rating' => $data['rating'],
                'icon'=>$data['icon'],
                'reviews_id'=>'1',
            ]);
        }}
}
