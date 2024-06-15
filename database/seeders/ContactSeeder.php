<?php

namespace Database\Seeders;

use App\Models\ContactData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'title_cta' => 'Ready to Get Started',
            'description_cta' => 'Start your project with a 14-day free trial',
            'text_button_cta' => 'Get Started',
            'title_contact' => 'Contact US',
            'first_description_contact' => 'Let\'s work',
            'second_description_contact' => 'together',
            'tertiary_description_contact' => 'Any question or remark? just write us a message',
            'text_contact' => 'Send a message',
            'description_contact' => 'If you would like to discuss anything related to payment, account, licensing,',
            'description_contact_two' => 'partnerships, or have pre-sales questions, you’re at the right place.',
            'email' => 'rawanjizzine38@gmail.com',
            'phone' => '123-456-7890',
            'text_button_contact' => 'Send inquiry',
        ];

        $path_cta = 'assets/uploads/images/contact/1.png';
        $path_contact =  'assets/uploads/images/contact/2.png';

        ContactData::create([
            'user_id'=>'1',
            'title_cta' => $data['title_cta'],
            'description_cta' => $data['description_cta'],
            'button_text_cta' => $data['text_button_cta'],
            'title_contact' => $data['title_contact'],
            'first_description_contact' => $data['first_description_contact'],
            'second_description_contact' => $data['second_description_contact'],
            'tertiary_description_contact' => $data['tertiary_description_contact'],
            'text_contact' => $data['text_contact'],
            'description_contact' => $data['description_contact'],
            'description_contact_two' => $data['description_contact_two'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'text_button_contact' => $data['text_button_contact'],
            'image_cta' => $path_cta,
            'image_contact' => $path_contact,
        ]);
    }
}
