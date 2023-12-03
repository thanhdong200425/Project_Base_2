<?php

namespace Database\Seeders;

use App\Models\Blog_Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Blog_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog_Category::factory()->count(10)->create();
    }
}
