<?php

namespace Database\Seeders;

use App\Models\Timeworking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Time_WorkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timeworking::factory()->count(10)->create();
    }
}
