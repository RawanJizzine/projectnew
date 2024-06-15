<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\FeaturesData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = Feature::first(); 
        if ($features) {
          
            FeaturesData::create([
                'title' => 'Quality Code',
                'description' => 'Code structure that all developers will easily understand and fall in love with.',
                'image'=>'assets/uploads/images/features/1.png',
                'features_id'=>'1',
            ]);
    
            FeaturesData::create([
                'title' => 'Continuous Updates',
                'description' => 'Free updates for the next 12 months, including new demos and features.',
                'image'=>'assets/uploads/images/features/2.png',
                'features_id'=>'1',
            ]);
    
            FeaturesData::create([
                'title' => 'Stater-Kit',
                'description' => 'Start your project quickly without having to remove unnecessary features.',
                'image'=>'assets/uploads/images/features/3.png',
                'features_id'=>'1',
            ]);
    
            FeaturesData::create([
                'title' => 'API Ready',
                'description' => 'Just change the endpoint and see your own data loaded within seconds.',
                'image'=>'assets/uploads/images/features/4.png',
                'features_id'=>'1',
            ]);
    
            FeaturesData::create([
                'title' => 'Excellent Support',
                'description' => 'An easy-to-follow doc with lots of references and code examples.',
                'image'=>'assets/uploads/images/features/5.png',
                'features_id'=>'1',
            ]);
    
            FeaturesData::create([
                'title' => 'Well Documented',
                'description' => 'An easy-to-follow doc with lots of references and code examples.',
                'image'=>'assets/uploads/images/features/6.png',
                'features_id'=>'1',
            ]);
            
        }
    }
}
