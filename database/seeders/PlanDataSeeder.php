<?php

namespace Database\Seeders;

use App\Models\PlanData;
use App\Models\PlanList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $basicPlan = PlanData::create([
            'plan_id'=>1,
            'title' => 'Basic',
            'text_button' => 'Get Started',
            'image' => 'assets/uploads/images/plans/1.png',
            'monthly_price' => 19,
            'yearly_price' => 14,
            'total_price' => 168,
        ]);
        $planbasic = [
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Home Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Feature Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Email Services',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Contact Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Message Here',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'Fun Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $basicPlan->id,
                'content_list' => 'CTA Section',
                'user_id' => '1',
            ],
           
        ];
        foreach ($planbasic as $item) {
            PlanList::create($item);
        }


        ///

      
        $teamPlan = PlanData::create([
            'plan_id'=>1,
            'title' => 'Team',
            'text_button' => 'Get Started',
            'image' => 'assets/uploads/images/plans/2.png',
            'monthly_price' => 29,
            'yearly_price' => 22,
            'total_price' => 264,
        ]);
        $planteam = [
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Home Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Feature Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Email Service',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Contact Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Team Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'Fun Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $teamPlan->id,
                'content_list' => 'CTA Section',
                'user_id' => '1',
            ],
           
        ];
        foreach ( $planteam as $item) {
            PlanList::create($item);
        }



       ///
        $enterprisePlan = PlanData::create([
            'plan_id'=>1,
            'title' => 'Enterprise',
            'text_button' => 'Get Started',
            'image' => 'assets/uploads/images/plans/3.png',
            'monthly_price' => 49,
            'yearly_price' => 37,
            'total_price' => 444,
        ]);
        $planenter = [
            [
                'plan_data_id' => $enterprisePlan->id,
                'content_list' => 'Home Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' =>$enterprisePlan->id,
                'content_list' => 'Feature Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $enterprisePlan->id,
                'content_list' => 'Review Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' =>$enterprisePlan->id,
                'content_list' => 'Contact Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $enterprisePlan->id,
                'content_list' => 'Team Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' => $enterprisePlan->id,
                'content_list' => 'Fun Section',
                'user_id' => '1',
            ],
            [
                'plan_data_id' =>$enterprisePlan->id,
                'content_list' => 'CTA Section',
                'user_id' => '1',
            ],
           
        ];
        foreach ( $planenter as $item) {
            PlanList::create($item);
        }



        ///
    }
}
