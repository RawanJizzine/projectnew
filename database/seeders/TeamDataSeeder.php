<?php

namespace Database\Seeders;

use App\Models\TeamData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample team data
        $teamData = [
            [
                'name' => 'Sophie Gilbert',
                'position' => 'Project Manager',
                'image' =>'assets/uploads/images/teams/1.png',
                'color_label' => 'bg-label-primary ',
                'color_border' => 'border-label-primary',
            ],
            [
                'name' => 'Paul Miles',
                'position' => 'UI Designer',
                'image' =>'assets/uploads/images/teams/2.png',
                'color_label' => 'bg-label-info',
                'color_border' => 'border-label-info',
            ],
            [
                'name' => 'Nannie Ford',
                'position' => 'Development Lead',
                'image' =>'assets/uploads/images/teams/3.png',
                'color_label' => 'bg-label-danger',
                'color_border' => 'border-label-danger',
            ],
            [
                'name' => 'Chris Watkins',
                'position' => 'Marketing Manager',
                'image' =>'assets/uploads/images/teams/4.png',
                'color_label' => 'bg-label-success',
                'color_border' => 'border-label-success',
            ],
        ];

        // Loop through the data and create team members
        foreach ($teamData as $data) {
            TeamData::create([
                'team_id'=>'1',
                'name' => $data['name'],
                'position' => $data['position'],
                'image' =>  $data['image'],
                'color_label' => $data['color_label'],
                'color_border' => $data['color_border'],
            ]);
        }
    }
}
