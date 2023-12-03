<?php

namespace Database\Seeders;

use App\Models\Default_Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Default_PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Default_Page::factory()->count(10)->create();
    }
}
