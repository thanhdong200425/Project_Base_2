<?php

namespace Database\Seeders;

use App\Models\Staff_Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Staff_PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff_Position::factory()->count(10)->create();
    }
}
