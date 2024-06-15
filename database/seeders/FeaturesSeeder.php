<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'title' => 'Useful Features',
            'main_description' => 'Everything you need',
            'secondary_description' => 'to start your next project',
            'tertiary_description' => 'Not just a set of tools, the package includes ready-to-deploy conceptual application',
            'user_id'=>'1',
           
        ]);
    }
}
