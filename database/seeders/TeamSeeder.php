<?php

namespace Database\Seeders;

use App\Models\TeamModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamModel::create([
            'title' => 'Our Great Team',
            'first_text' => 'Supported',
            'second_text' => 'by Real People',
            'tertiary_text' => 'Who is behind these great-looking interfaces?',
            'user_id'=>'1',
        ]); 
    }
}
