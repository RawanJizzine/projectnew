<?php

namespace Database\Seeders;

use App\Models\LogoData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $logoData = [
            [
                'image' => 'assets/uploads/images/logo/1.png',
            ],
            [
                'image' => 'assets/uploads/images/logo/2.png',
            ],
            [
                'image' => 'assets/uploads/images/logo/3.png',
            ],
            [
                'image' => 'assets/uploads/images/logo/4.png',
            ],
            [
                'image' => 'assets/uploads/images/logo/5.png',
            ],
        ];

        foreach ($logoData as $data) {
           
            LogoData::create([
                'user_id' => '1', 
                'image' => $data['image'],
            ]);
        }
    }
}
