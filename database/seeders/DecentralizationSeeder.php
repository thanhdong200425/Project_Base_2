<?php

namespace Database\Seeders;

use App\Models\Decentralization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DecentralizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Decentralization::factory()->create(['name' => 'admin']);
        Decentralization::factory()->create(['name' => 'user']);
        Decentralization::factory()->create(['name' => 'guest']);
    }
}
