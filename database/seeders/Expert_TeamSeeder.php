<?php

namespace Database\Seeders;

use App\Models\Expert_Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Expert_TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expert_Team::factory()->count(10)->create();
    }
}
