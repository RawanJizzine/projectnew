<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(UsersTableSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(FeaturesSeeder::class);
        $this->call(FeaturesDataSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ReviewsDataSeeder::class);
        $this->call(LogoSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TeamDataSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(PlanDataSeeder::class);
        $this->call(FunDataSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(FaqDataSeeder::class);
        $this->call(ContactSeeder::class);

    }
}
