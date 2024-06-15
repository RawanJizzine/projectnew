<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faqMain=Faq::first(); 
        $faqs = [
            [
                'title' => 'Do you charge for each upgrade?',
                'description' => 'Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping soufflé. Wafer gummi bears marshmallow pastry pie.'
            ],
            [
                'title' => 'Do I need to purchase a license for each website?',
                'description' => 'Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies. Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.'
            ],
            [
                'title' => 'What is regular license?',
                'description' => 'Regular license can be used for end products that do not charge users for access or service (access is free and there will be no monthly subscription fee). Single '
            ],
            [
                'title' => 'What is extended license?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid quaerat possimus maxime! Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum maxime, blanditiis earum ea, incidunt quam possimus cumque.'
            ],
            [
                'title' => 'Which license is applicable for SASS application?',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias exercitationem ab cum nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia ipsam quasi labore enim architecto non!'
            ]
        ];

        foreach ($faqs as $faq) {
            FaqModel::create([
                'faq_id'=>$faqMain->id,
                'title' => $faq['title'],
                'description' => $faq['description'],
            ]);
        }
    }
}
