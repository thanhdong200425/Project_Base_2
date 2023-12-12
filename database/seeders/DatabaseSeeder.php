<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BillSeeder::class,
            Blog_CategorySeeder::class,
            BlogSeeder::class,
            CommentSeeder::class,
            DecentralizationSeeder::class,
            Default_PageSeeder::class,
            Default_PageSeeder::class,
            Expert_TeamSeeder::class,
            Login_TokenSeeder::class,
            PetSeeder::class,
            ProductSeeder::class,
            PromotionSeeder::class,
            ServiceSeeder::class,
            Staff_PositionSeeder::class,
            Time_WorkingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
